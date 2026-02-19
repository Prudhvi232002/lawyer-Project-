<template>
    <Section v-if="featured_law_firms.length > 0" :heading="__n('law_firm')">
      <template #paragraph>
        <p class="text-center mb-4">The Top Rated section highlights positive healing professionals and law_firms  who have built a strong reputation on the GHCN platform. All ratings are 100% user generated, these law_firms represent some of the top talent in this global community. Top rated law_firms have the highest positive feedback from other users like yourself, time after time. Each law_firm has been highly rated for their well rounded skills, compassion, support, and ability to help transform the lives of their clients.</p>
      </template>
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
            <Link :href="route('law_firms.listing')" class="btn btn-primary">{{ __('view more') }}</Link>
          </div>
        </div>
    </Section>
    <div v-else>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";
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
  created(){
    this.getFeaturedLawFirms()
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      featured_law_firms:[],
      settings: {
        itemsToShow: 1,
        snapAlign: 'start',
      },
    // breakpoints are mobile firstTop Featured LawFirms
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 2,
        snapAlign: 'start',
      },
      // 1024 and up
      1024: {
        itemsToShow: 4,
        snapAlign: 'start',
      },
    },
    };
  },
  methods: {
    getFeaturedLawFirms(){
        axios.get(this.route('getApiFeaturedLawFirms')).then(res => {
                this.featured_law_firms = res.data.data
            });
    },
    submit() {
    },
  },
});
</script>
