<template>
  <app-layout title="Lawyers">
    <template #header></template>

    <div class="py-5 border-bottom border-dark">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div
              v-if="
                getPageContentType('lawyers_page_description') == 'textarea'
              "
            >
              <div v-html="getPageContent('lawyers_page_description')"></div>
            </div>
            <div
              v-else-if="
                getPageContentType('lawyers_page_description') == 'text'
              "
            >
              <p>{{ getPageContent("lawyers_page_description") ?? "-" }}</p>
            </div>
            <div v-else>
              <h2 class="fs-2 text-center">
                <span class="fw-normal">Search Lawyer | </span>
                <span class="fw-bold">Make An Appointment</span>
              </h2>
              <p class="text-center mb-0">Discover The Best Lawyers Near You</p>
            </div>

            <breadcrums :breadcrums="breadcrums"></breadcrums>
          </div>
        </div>
      </div>
    </div>
    <div class="section pt-0">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="search-side-bar">
              <div class="d-flex mt-3 flex-wrap">
                <button
                  :class="list_view ? 'btn-primary' : 'btn-dark'"
                  class="btn me-2 mt-3"
                  @click="listView()"
                >
                  <i class="bi bi-list"></i>
                  {{ getPageContent("general_list_btn_text") ?? "List View" }}
                </button>
                <button
                  :class="grid_view ? 'btn-primary' : 'btn-dark'"
                  class="btn mt-3"
                  @click="GridView()"
                >
                  <i class="bi bi-grid"></i>
                  {{ getPageContent("general_grid_btn_text") ?? "Grid View" }}
                </button>
              </div>
              <find-lawyer-bar
                @getLawyers="onSearch"
                :is_redirect="false"
                :is_lawyer_page="true"
              ></find-lawyer-bar>
            </div>
          </div>

          <div class="col-md-9">
            <div class="row h-100" :class="list_view ? 'ListView' : 'GridView'">
              <div class="col-12 border-start border-dark" v-if="fetching">
                <div class="row h-100">
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
              <div class="col-12 border-start border-dark" v-if="!fetching">
                <div v-if="lawyers.data.length > 0" class="row h-100">
                  <div
                    :class="
                      list_view
                        ? 'col-12 p-0'
                        : 'col-md-4 border-end border-bottom border-dark'
                    "
                    v-for="(lawyer, index) in lawyers.data"
                    :key="index"
                  >
                    <div v-if="list_view">
                      <lawyer-listing-card
                        :add_col="true"
                        :list_card="true"
                        :key="lawyer.id"
                        :lawyer="lawyer"
                      ></lawyer-listing-card>
                    </div>

                    <div class="h-100" v-if="grid_view">
                      <lawyer-grid-card
                        :add_col="false"
                        :key="lawyer.id"
                        :lawyer="lawyer"
                      ></lawyer-grid-card>
                    </div>
                  </div>
                </div>

                <div v-else class="row mx-0 h-100">
                  <div class="col-12 text-center mb-3">
                    <record-not-found></record-not-found>
                  </div>
                </div>
              </div>

              <div class="row mt-4" v-if="!fetching">
                <div
                  class="col-md-12 d-flex align-items-center justify-content-center"
                >
                  <button
                    v-if="lawyers.meta.last_page != this.filter.page"
                    @click="loadMore()"
                    class="btn btn-primary position-relative"
                    :disabled="loading_more"
                  >
                    <span
                      :class="{
                        loader: loading_more,
                      }"
                      class="position-absolute"
                    ></span>
                    {{
                      getPageContent("general_load_btn_text") ?? __("load more")
                    }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <spotlight-lawyer-section></spotlight-lawyer-section>

    <!-- <featured-lawyer-section findLawyers="true"></featured-lawyer-section> -->
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import FindLawyerBar from "@/Components/Lawyers/FindLawyerBar.vue";
import SpotlightLawyerSection from "@/Components/Lawyers/SpotlightLawyerSection.vue";
import FeaturedLawyerSection from "@/Components/Lawyers/FeaturedLawyerSection.vue";
import LawyerGridCard from "@/Components/Lawyers/LawyerGridCard.vue";
import LawyerListingCard from "@/Components/Lawyers/LawyerListingCard.vue";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
  mixins: [PaginationMixin],
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    FindLawyerBar,
    SpotlightLawyerSection,
    FeaturedLawyerSection,
    LawyerGridCard,
    LawyerListingCard,
    SpotlightCardSkeleton,
    RecordNotFound,
    Breadcrums,
  },
  created() {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        let lat = position.coords.latitude;
        let lng = position.coords.longitude;
        (this.filter.latitude = lat), (this.filter.longitude = lng);
      },
      (error) => {}
    );
  },
  data() {
    return {
      lawyers: {},
      grid_view: false,
      list_view: true,
      breadcrums: [
        {
          id: 1,
          name: this.__('home'),
          link: "/",
        },
        {
          id: 2,
          name: this.__('lawyers'),
          link: "",
        },
      ],

    };
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getLawyers(loading_more);
    },
    getLawyers(loading_more) {
      // if(Object.keys(route().params).length > 0){
      //     this.$inertia.replace(route('lawyers.listing'))
      // }
      axios.post(this.route("getApiLawyers"), this.filter).then((res) => {
        const data = res.data.data;
        if (loading_more) {
          this.lawyers.data = this.lawyers.data.concat(data.data);
        } else {
          this.lawyers.data = data.data;
        }
        this.lawyers.links = data.links;
        this.lawyers.meta = data.meta;
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
    },
  },
});
</script>
