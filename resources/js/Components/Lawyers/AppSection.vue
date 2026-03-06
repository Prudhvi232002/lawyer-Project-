<template>
    <div class="section customer-app">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mobile-img text-end mb-4 mb-lg-0" data-aos="fade-right" data-aos-once="false"
                            data-aos-duration="1500" data-aos-delay="500">
                            <img src="@/images/home/mobile-2.png" width="450" alt class="img-fluid" />
                        <div class="back-shadow">adsfasdfasdfasdfasasdf</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center flex-column h-100" data-aos="fade-left"
                            data-aos-once="false" data-aos-duration="1500" data-aos-delay="800">

                            <div  v-if="getPageContentType('app_section_description') == 'textarea'">
                                      <div v-html="getPageContent('app_section_description')"> </div>
                                    </div>
                                <div  v-else-if="getPageContentType('app_section_description') == 'text'">
                                    <p> {{getPageContent('app_section_description') ?? '-'}} </p>
                            </div>
                            <div v-else>
                                <span class="fs-3">{{ __("Download") }}</span>
                                    <h2 class="display-6">
                                        {{ __("Consultant App") }}
                                    </h2>
                                    <p>
                                        Our commitment to excellence extends to our
                                        commitment to integrity. We adhere to the
                                        highest ethical standards, treating each case
                                        with the utmost professionalism and
                                        confidentiality. We understand the gravity of
                                        the legal matters we handle, and we approach
                                        them with the respect and dedication they
                                        deserve.
                                    </p>

                                    <p class="fs-3">
                                        {{ __("Get the link to download the app") }}
                                    </p>
                            </div>


                            <div class="d-flex align-items-center flex-lg-row flex-column">

                            <div v-if="getPageContent('app_section_app_store_btn_text') != '' && getPageContent('app_section_app_store_btn_text') != null"  class=" btn-store d-flex rounded-pill me-4 mb-4 mb-lg-0">
                                    <i class="bi bi-apple fs-3 me-3"></i>
                                    <div  v-if="getPageContentType('app_section_app_store_btn_text') == 'textarea'">
                                      <div v-html="getPageContent('app_section_app_store_btn_text')"> </div>
                                    </div>
                                    <div  v-else-if="getPageContentType('app_section_app_store_btn_text') == 'text'">
                                        <p> {{getPageContent('app_section_app_store_btn_text') ?? '-'}} </p>
                                </div>
                                    <div v-else>
                                        <span class="btn-label">{{
                                            __("Download on the")
                                        }}</span>
                                        <span class="btn-caption">{{
                                            __("App Store")
                                        }}</span>
                                    </div>
                            </div>

                                <div v-if="getPageContent('app_section_play_btn_text') != '' && getPageContent('app_section_play_btn_text') != null"  class="btn-store d-flex rounded-pill">
                                    <i class="bi bi-google-play fs-3 me-3"></i>
                                    <div  v-if="getPageContentType('app_section_play_btn_text') == 'textarea'">
                                      <div v-html="getPageContent('app_section_play_btn_text')"> </div>
                                    </div>
                                    <div  v-else-if="getPageContentType('app_section_play_btn_text') == 'text'">
                                        <p> {{getPageContent('app_section_play_btn_text') ?? '-'}} </p>
                                </div>
                                    <div v-else>
                                        <span class="btn-label">{{
                                            __("Get it on")
                                        }}</span>
                                        <span class="btn-caption">{{
                                            __("Google Store")
                                        }}</span>
                                    </div>
                                </div>
                            </div>
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
  created() {
    
  },
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
