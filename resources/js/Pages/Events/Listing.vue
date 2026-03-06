<template>
  <app-layout title="My Profile">
    <template #header></template>

    <div class="row mx-0 border-bottom border-dark py-5">
      <div class="col-12 text-center"
            v-if="
                getPageContentType('events_page_description') == 'textarea'
              "
            >
              <div v-html="getPageContent('events_page_description')"></div>
            </div>
            <div class="col-12 text-center"
              v-else-if="
                getPageContentType('events_page_description') == 'text'
              "
            >
              <p>{{ getPageContent("events_page_description") ?? "-" }}</p>
            </div>


      <div v-else class="col-12 text-center">
        <p class="fs-2 mb-0">
          Search Events |
          <span class="fw-bold">{{ __('upcoming') }} {{ __n('event') }}</span>
        </p>
        <!-- <p>Discover The Best Lawyers Near You</p> -->
      </div>
      <breadcrums :breadcrums="breadcrums"></breadcrums>
    </div>

    <div class="section p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="search-side-bar">
              <div class="d-flex flex-wrap mt-3">
                <button
                  :class="list_view ? 'btn-primary' : 'btn-dark'"
                  class="btn me-2 mb-3"
                  @click="listView()"
                >
                  <i class="bi bi-list"></i>
                  {{ __('list view') }}
                </button>
                <button
                  :class="grid_view ? 'btn-primary' : 'btn-dark'"
                  class="btn mb-3"
                  @click="GridView()"
                >
                  <i class="bi bi-grid"></i>
                  {{ __('grid view') }}
                </button>
              </div>
              <find-event-bar @getEvents="onSearch" :is_redirect="false"></find-event-bar>
            </div>
          </div>

          <div class="col-md-9 border-start border-dark">
            <div class="row mb-5 h-100" :class="list_view ? 'ListView' : 'GridView'">
              <!-- <div class="col-12 mb-5">
                            <h2 class="text-center">{{ __('upcoming') }} {{ __n('event') }}</h2>
              </div>-->
              <div class="col-12" v-if="fetching">
                <div class="row  h-100">
                    <div class="col-12 p-0">
                        <spotlight-card-skeleton></spotlight-card-skeleton>
                    </div>
                    <div class="col-12 p-0">
                        <spotlight-card-skeleton></spotlight-card-skeleton>
                    </div>
                    <div class="col-12 p-0">
                        <spotlight-card-skeleton></spotlight-card-skeleton>
                    </div>
                    <div class="col-12 p-0">
                        <spotlight-card-skeleton></spotlight-card-skeleton>
                    </div>
                    <div class="col-12 p-0">
                        <spotlight-card-skeleton></spotlight-card-skeleton>
                    </div>
                </div>
              </div>
              <div class="col-12" :class="list_view ? 'p-0' : ''" v-if="!fetching">
                <div v-if="events.data.length > 0" class="row">
                  <div :class="list_view ? 'col-12' : 'col-md-6 mt-4'" v-for="(event,index) in events.data" :key="index">
                        <event-card v-if="grid_view" :add_col="false" :key="event.id" :event="event"></event-card>
                    <event-listing-card v-if="list_view" :add_col="false" :key="event.id" :event="event"></event-listing-card>
                </div>
                </div>

                <div v-else class="row h-100">
                    <div class="col-12 text-center mb-3">
                        <record-not-found></record-not-found>
                    </div>
                </div>
                <div class="row" v-if="events.meta.last_page != this.filter.page">
                  <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <button
                      @click="loadMore()"
                      class="btn btn-primary  position-relative mt-3"
                      :disabled="loading_more"
                    >
                      <span
                        :class="{
                                        'loader': loading_more
                                    }"
                        class="position-absolute"
                      ></span>
                      {{__('load more')}}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <spotlight-lawyer-section></spotlight-lawyer-section>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import FindEventBar from "@/Components/Events/FindEventBar.vue";
import SpotlightLawyerSection from "@/Components/Lawyers/SpotlightLawyerSection.vue";
import EventCard from "@/Components/Events/EventCard.vue";
import EventListingCard from "@/Components/Events/EventListingCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
  mixins: [PaginationMixin],
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    EventCard,
    FindEventBar,
    SpotlightLawyerSection,
    EventListingCard,
    RecordNotFound,
    SpotlightCardSkeleton,
    Breadcrums
  },
  created() {},
  data() {
    return {
      events: {},
      grid_view: false,
      list_view: true,
      breadcrums:[
                {
                    id:1,
                    name:this.__('home'),
                    link:'/'
                },
                {
                    id:2,
                    name:this.__(`events`),
                    link:''
                }
            ]
    };
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getEvents(loading_more);
    },
    getEvents(loading_more) {
      // if(Object.keys(route().params).length > 0){
      //     this.$inertia.replace(route('events.listing'))
      // }
      axios.post(this.route("getApiEvents"), this.filter).then(res => {
        const data = res.data.data;
        if (loading_more) {
          this.events.data = this.events.data.concat(data.data);
        } else {
          this.events.data = data.data;
        }
        this.events.links = data.links;
        this.events.meta = data.meta;
        this.fetching = false;
      });
    },
    listView() {
      this.list_view = true;
      this.grid_view = false;
    },

    GridView() {
      this.list_view = false;
      this.grid_view = true;
    }
  }
});
</script>
