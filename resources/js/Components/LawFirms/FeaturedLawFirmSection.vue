<template>
  <Section class="bg-light" :class="{ 'find-law-firms': findLawFirms }" v-if="featured_law_firms.length > 0" >
    <div class="row">
        <div class="col-12 mb-4 text-center">
          <div class="col-12" v-if="getPageContentType('featured_law_firms_description') == 'textarea'"> 
                                      <div v-html="getPageContent('featured_law_firms_description')"> </div>
                                    </div>
                        <div class="col-12" v-else-if="getPageContentType('featured_law_firms_description') == 'text'">
                            <p> {{getPageContent('featured_law_firms_description') ?? '-'}} </p>
                    </div>
                    <div v-else>
                      <span class="fs-3">{{
                __("Are you Looking For")
            }}</span>
            <h2 class="display-6">{{ __("Featured LawFirm") }}</h2>
                    </div>
        </div>
    </div>
    <!-- <template #paragraph>
      <p class="text-center mb-4">Your overall healing and well-being matters to us which is why we’re excited to partner with world renowned law_firms and integrated law_firms. When dealing with unresolved or unexplained physical or emotional issues and trauma, having a guide and community to help and support you along your path to finding a solution that works for you is something we all can benefit from! Connect with our top rated law_firms and law_firms.</p>
    </template> -->
    <Carousel :settings="settings" :breakpoints="breakpoints">
      <Slide v-for="law_firm in featured_law_firms" :key="law_firm.id">
        <law-firm-card :law_firm="law_firm"></law-firm-card>
      </Slide>
      <template #addons>
        <Navigation />
      </template>
    </Carousel>
    <div class="row pt-4 justify-content-center">
      <div class="col-md-3 d-flex justify-content-center">
        <Link :href="route('law_firms.listing')" class="learn-more btn position-relative" style="width:14rem">
            <span class="circle" aria-hidden="true">
              <span class="icon arrow"></span>
            </span>
            <span class="button-text">{{  getPageContent('general_view_more_btn_text') ??  __('view more') }}</span>
          </Link>
        <!-- <Link :href="route('law_firms.listing')" class="btn rounded-5 border-0 px-4 text-white btn-primary">{{ __('view more') }}</Link> -->
      </div>
    </div>
  </Section>
  <div v-else>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import LawFirmCard from "@/Components/LawFirms/LawFirmCard.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import Section from "@/Components/Section.vue";

export default defineComponent({
  components: {
    LawFirmCard,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Section
  },
  created() {
    this.getFeaturedLawFirms()
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      featured_law_firms: [],
      settings: {
        itemsToShow: 1,
        snapAlign: 'start',
      },
      // breakpoints are mobile first
      // any settings not specified will fallback to the carousel settings
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 1,
          snapAlign: 'start',
        },
        // 1024 and up
        1024: {
          itemsToShow: 1,
          snapAlign: 'start',
        },
      },
    };
  },
  methods: {
    getFeaturedLawFirms() {
      axios.get(this.route('getApiFeaturedLawFirms')).then(res => {
        this.featured_law_firms = res.data.data
      });
    },
    submit() {
    },
  },
  props: [
    'findLawFirms'
  ]
});
</script>
