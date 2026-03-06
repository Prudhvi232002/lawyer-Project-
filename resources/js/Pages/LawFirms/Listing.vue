<template>
  <app-layout title="LawFirm">
    <template #header></template>

    <div class="py-5 border-bottom border-dark">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div
              v-if="
                getPageContentType('law_firms_page_description') == 'textarea'
              "
            >
              <div v-html="getPageContent('law_firms_page_description')"></div>
            </div>
            <div
              v-else-if="
                getPageContentType('law_firms_page_description') == 'text'
              "
            >
              <p>{{ getPageContent("law_firms_page_description") ?? "-" }}</p>
            </div>
            <div v-else>
              <h2 class="fs-2 text-center">
                <span class="fw-normal">Search Lawfirms | </span>
                <span class="fw-bold">Make An Appointment</span>
              </h2>
              <p class="text-center mb-0">Discover The Best Lawfirms Near You</p>
            </div>

            <breadcrums :breadcrums="breadcrums"></breadcrums>
          </div>
        </div>
      </div>
    </div>


    <div class="section p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="search-side-bar">
              <div class="d-flex mt-3 flex-wrap">
                <button :class="list_view ? 'btn-primary' : 'btn-dark'" class="btn me-2 mt-3" @click="listView()">
                  <i class="bi bi-list"></i>
                  {{ getPageContent("general_list_btn_text") ?? "Grid View" }}
                </button>
                <button :class="grid_view ? 'btn-primary' : 'btn-dark'" class="btn mt-3" @click="GridView()">
                  <i class="bi bi-grid"></i>
                  {{ getPageContent("general_grid_btn_text") ?? "Grid View" }}
                </button>
              </div>
              <find-law-firm-bar @getLawFirms="onSearch"  :is_law_firm_page="true" :is_redirect="false"></find-law-firm-bar>
            </div>
          </div>
          <div class="col-md-9 border-start border-dark">
            <div class="row h-100" :class="list_view ? 'ListView' : 'GridView'">
                <div
                class="col-12 border-start border-dark"
                v-if="fetching"
            >
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
              <div class="col-12" v-if="!fetching">
                <div v-if="law_firms.data.length > 0" class="row">
                  <div v-for="(law_firm, index) in law_firms.data" :key="index" :class="
                  list_view
                      ? 'col-12 p-0'
                      : 'col-md-4 border-end border-bottom border-dark'
              ">
                    <div v-if="list_view">
                        <law-firm-listing-card
                            :add_col="true"
                            :list_card="true"
                            :key="law_firm.id"
                            :law_firm="law_firm"
                        ></law-firm-listing-card>
                    </div>

                    <div class="h-100" v-if="grid_view">
                        <law-firm-grid-card
                            :add_col="false"
                            :key="law_firm.id"
                            :law_firm="law_firm"
                        ></law-firm-grid-card>
                    </div>

                  </div>

                </div>
                <div v-else class="row h-100">
                  <div class="col-12 text-center mb-3">
                    <record-not-found></record-not-found>
                  </div>
                </div>
                <div class="row" v-if="law_firms.meta.last_page != this.filter.page">
                  <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <button @click="loadMore()" class="btn btn-primary position-relative" :disabled="loading_more">
                      <span :class="{
                        'loader': loading_more
                      }" class="position-absolute"></span>
                      {{ __('load more') }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <spotlight-law-firm-section></spotlight-law-firm-section>

    <!-- <featured-law-firm-section findLawFirms="true"></featured-law-firm-section> -->
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import FindLawFirmBar from "@/Components/LawFirms/FindLawFirmBar.vue";
import SpotlightLawFirmSection from "@/Components/LawFirms/SpotlightLawFirmSection.vue";
import FeaturedLawFirmSection from "@/Components/LawFirms/FeaturedLawFirmSection.vue";
import LawFirmCard from "@/Components/LawFirms/LawFirmCard.vue";
import LawFirmListingCard from "@/Components/LawFirms/LawFirmListingCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
import LawFirmGridCard from "@/Components/LawFirms/LawFirmGridCard.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
  mixins: [PaginationMixin],
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    FindLawFirmBar,
    SpotlightLawFirmSection,
    FeaturedLawFirmSection,
    LawFirmListingCard,
    LawFirmCard,
    RecordNotFound,
    SpotlightCardSkeleton,
    LawFirmGridCard,
    Breadcrums
  },
  created() { },
  data() {
    return {
      law_firms: {},
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
                    name:this.__('law_firm'),
                    link:''
                }
            ]
    };
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getLawFirms(loading_more);
    },
    getLawFirms(loading_more) {
      // if(Object.keys(route().params).length > 0){
      //     this.$inertia.replace(route('law_firms.listing'))
      // }
      axios.post(this.route("getApiLawFirms"), this.filter).then(res => {
        const data = res.data.data;
        if (loading_more) {
          this.law_firms.data = this.law_firms.data.concat(data.data);
        } else {
          this.law_firms.data = data.data;
        }
        this.law_firms.links = data.links;
        this.law_firms.meta = data.meta;
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
