<template>
  <Section v-if="!fetching && featured_lawyers.length > 0" >

    <Carousel  :key="key" :settings="settings" :breakpoints="breakpoints">
      <Slide v-for="lawyer in featured_lawyers" :key="lawyer.id">
        <lawyer-card :lawyer="lawyer"></lawyer-card>
      </Slide>
      <template #addons>
        <Navigation />
      </template>
    </Carousel>
    <div class="row mt-5 justify-content-center">
      <div class="col-md-3 d-flex justify-content-center">
        <Link :href="route('lawyers.listing')" class="learn-more btn position-relative" style="width:14rem">
            <span class="circle" aria-hidden="true">
              <span class="icon arrow"></span>
            </span>
            <span class="button-text">{{ getPageContent('general_find_lawyer_btn_text') ?? __('find lawyer') }}</span>
          </Link>
      </div>
    </div>
  </Section>
  <Section v-else-if="!fetching && featured_lawyers.length == 0">
    <record-not-found></record-not-found>
    </Section>
  <Section v-else >
    <Carousel  :key="key" :settings="settings" :breakpoints="breakpoints">
        <Slide v-for="slide in 4" :key="slide">
          <card-skeleton></card-skeleton>
        </Slide>
        <template #addons>
          <Navigation />
        </template>
      </Carousel>
  </Section>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import LawyerCard from "@/Components/Lawyers/LawyerCard.vue";
import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import Section from "@/Components/Section.vue";
import RecordNotFound from "../Shared/RecordNotFound.vue";

export default defineComponent({
  components: {
    LawyerCard,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Section,
    CardSkeleton,
    RecordNotFound
  },
  created() {
    if (this.featured_lawyers.length == 0) {
        this.getFeaturedLawyers();
    }
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      featured_lawyers: [],
      key:1,
      fetching:true,
      settings: {
        itemsToShow: 1,
        snapAlign: 'start',
        autoplay:false,
          wrapAround:'true'
      },
    // breakpoints are mobile firstTop Featured Lawyers
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 1,
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
    getFeaturedLawyers() {
      axios.get(this.route('getApiFeaturedLawyers')).then(res => {
        this.fetching = false
        this.featured_lawyers = res.data.data
      });
    },
    submit() {
    },
  },
  props: [
    'findLawyers',
    'refresh'
  ],
  watch: {
    refresh(newVal,oldVal){
        this.key ++
    }
    }
});
</script>
