<template>
   <div class="section nearest-lawyer mt-5 pt-5">
            <div class="container">
                <div class="row py-md-5 align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                        <img class="img-fluid" width="350" src="@/images/home/group3.png" alt="Image"/>
                    </div>

                    <div class="col-lg-6">
                        <div v-if="getPageContentType('find_nearest_lawyer_description') == 'textarea'">
                         <div v-html="getPageContent('find_nearest_lawyer_description')"> </div>
                      </div>
                        <div v-else-if="getPageContentType('find_nearest_lawyer_description') == 'text'">
                            <p> {{getPageContent('find_nearest_lawyer_description') ?? '-'}} </p>
                         </div>
                         <div v-else>
                            <span class="fs-3">{{ __("Find Your") }}</span>
                        <h2 class="display-6">
                            {{ __("Nearest Lawyers") }}
                        </h2>

                        <p>
                            {{ __("resonance healing energy description") }}
                        </p>
                         </div>
                        <div>
                            <a :href="route('lawyers.listing')" class="btn btn-primary">{{ getPageContent('find_nearest_lawyer_button_text') ?? __("Find Nearest Lawyers") }}</a>
                        </div>
                    </div>
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
