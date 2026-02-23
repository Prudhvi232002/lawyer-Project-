<template>
    <div class="free-consulation pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="@/images/home/27718-5-business-people-hd.png" alt style="margin-top: -100px"
                            class="img-fluid" data-aos="fade-right" data-aos-once="false" data-aos-duration="1500"
                            data-aos-delay="800" />
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="py-5 my-3 text-capitalize" data-aos="fade-left" data-aos-once="false" data-aos-duration="1500"
                            data-aos-delay="800">
                            <div class="col-12" v-if="getPageContentType('free_consultation_description') == 'textarea'">
                                      <div v-html="getPageContent('free_consultation_description')"> </div>
                                    </div>
                            <div class="col-12" v-else-if="getPageContentType('free_consultation_description') == 'text'">
                                    <p> {{getPageContent('free_consultation_description') ?? '-'}} </p>
                            </div>
                            <div v-else>
                                <h4 class="display-4 fw-bolder text-white ">
                                {{ __("Free online consultations") }}
                            </h4>
                            <p class="fs-2 fw-bolder text-white">
                                {{ __("Starting at $15/month") }}
                            </p>
                            </div>
                            <span v-if="$page.props.auth && $page.props.settings.commission_type == 'subscription_base'">
                                <a v-if="$page.props.auth.logged_in_as == 'lawyer'" :href="route('pricing', { type: 'lawyer' })" class="btn btn-primary" type="button">{{ getPageContent('free_consultation_button') ?? __("Get Membership") }}</a>
                                <a v-if="$page.props.auth.logged_in_as == 'law_firm'" :href="route('pricing', { type: 'law_firm' })" class="btn btn-primary" type="button">{{ getPageContent('free_consultation_button') ?? __("Get Membership") }}</a>
                            </span>
                            <a v-else :href="route('register', { tab: 'lawyer' })" class="btn btn-primary" type="button">{{ getPageContent('free_consultation_button') ?? __("Get Membership") }}</a>
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
