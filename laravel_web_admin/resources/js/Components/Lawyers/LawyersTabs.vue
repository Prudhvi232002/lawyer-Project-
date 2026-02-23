<template>
  <div
    class="lawyer-tabs section pt-3 mt-5 d-flex flex-column align-items-center justify-content-center"
  >
    <div class="container">
      <div class="row">
        <div class="col-12 mb-4 text-center">
          <div
            v-if="getPageContentType('lawyers_tabs_description') == 'textarea'"
          >
            <div v-html="getPageContent('lawyers_tabs_description')"></div>
          </div>
          <div
            v-else-if="getPageContentType('lawyers_tabs_description') == 'text'"
          >
            <p>{{ getPageContent("lawyers_tabs_description") ?? "-" }}</p>
          </div>
          <div v-else>
            <span class="fs-3">{{ __("Are you Looking") }}</span>
            <h2 class="display-6">{{ __("Qualified Lawyers") }}</h2>
          </div>
        </div>
      </div>
      <ul
        class="nav nav-pills mb-3  rounded-pill p-3 text-center d-flex align-items-center justify-content-center" style="margin: 0 auto; background-color: var(--tertiary-color);"
        id="pills-tab"
        role="tablist"
      >
        <li class="nav-item" role="presentation">
          <button
            class="nav-link rounded-pill text-black shadow-none active"
            id="pills-featured-lawyers-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-featured-lawyers"
            type="button"
            @click="refreshSlider('featured')"
            role="tab"
            aria-controls="pills-featured-lawyers"
            aria-selected="false"
          >
            {{ getPageContent("lawyers_tabs_button_2") ?? "Featured Lawyers" }}
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link rounded-pill me-3 shadow-none text-black"
            id="pills-top-rated-lawyers-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-top-rated-lawyers"
            type="button"
            @click="refreshSlider('top_rated')"
            role="tab"
            aria-controls="pills-top-rated-lawyers"
            aria-selected="true"
          >
            {{ getPageContent("lawyers_tabs_button_1") ?? "Top Rated Lawyers" }}
          </button>
        </li>
        <!-- <li class="nav-item" role="presentation">
                <button
                    class="nav-link rounded-pill mx-3 text-dark fw-bolder"
                    id="pills-all-lawyers-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-all-lawyers"
                    type="button"
                    @click="refreshSlider('all')"
                    role="tab"
                    aria-controls="pills-all-lawyers"
                    aria-selected="false"
                >
                    All Lawyers
                </button>
            </li> -->
      </ul>
      <div class="tab-content w-100" id="pills-tabContent">
        <div
          class="tab-pane fade"
          id="pills-top-rated-lawyers"
          role="tabpanel"
          aria-labelledby="pills-top-rated-lawyers-tab"
        >
          <div class="container">
            <div class="row">
              <div class="col-12">
                <top-rated-lawyer-section
                  class="py-2"
                  :refresh="top_rated_key"
                  background="true"
                  v-if="top_rated_tab"
                ></top-rated-lawyer-section>
              </div>
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade show active"
          id="pills-featured-lawyers"
          role="tabpanel"
          aria-labelledby="pills-featured-lawyers-tab"
        >
          <div class="container">
            <div class="row">
              <div class="col-12">
                <featured-lawyer-section
                  class="py-2"
                  :refresh="featured_key"
                  findLawyers="true"
                  v-if="featured_tab"
                ></featured-lawyer-section>
              </div>
            </div>
          </div>
        </div>
        <!-- <div
                class="tab-pane fade"
                id="pills-all-lawyers"
                role="tabpanel"
                aria-labelledby="pills-all-lawyers-tab"
            >
            <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <all-lawyer-section
                                class="py-2"
                                findLawyers="true"
                                :refresh="all_lawyer_key"
                                v-if="all_lawyer_tab"

                            ></all-lawyer-section>
                        </div>
                    </div>
                </div>
            </div> -->
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import FeaturedLawyerSection from "@/Components/Lawyers/FeaturedLawyerSection.vue";
import TopRatedLawyerSection from "@/Components/Lawyers/TopRatedLawyerSection.vue";
import AllLawyerSection from "@/Components/Lawyers/AllLawyerSection.vue";
// import LawyerCard from "@/Components/Lawyers/LawyerCard.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import Section from "@/Components/Section.vue";
import { ref } from "vue";

export default defineComponent({
  components: {
    // LawyerCard,
    FeaturedLawyerSection,
    TopRatedLawyerSection,
    AllLawyerSection,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Section,
  },
  created() {},
  data() {
    return {
      form: this.$inertia.form({}),
      top_rated_tab: false,
      featured_tab: true,
      all_lawyer_tab: false,
      top_rated_key: 1,
      featured_key: 1,
      all_lawyer_key: 1,
    };
  },
  methods: {
    refreshSlider(tab) {
      if (tab == "top_rated") {
        this.top_rated_tab = true;
        this.top_rated_key++;
      }
      if (tab == "featured") {
        this.featured_tab = true;
        this.featured_key++;
      }
      if (tab == "all") {
        this.all_lawyer_tab = true;
        this.all_lawyer_key++;
      }
    },
    submit() {},
  },
});
</script>
<style scoped>
.active{
    color: white !important;
}
</style>
