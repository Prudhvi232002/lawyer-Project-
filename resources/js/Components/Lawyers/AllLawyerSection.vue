<template>
  <Section v-if="lawyers.length > 0" >

    <Carousel :settings="settings" :breakpoints="breakpoints">
      <Slide v-for="lawyer in lawyers" :key="lawyer.id">
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
            <span class="button-text">{{ __('find lawyer') }}</span>
          </Link>
      </div>
    </div>
  </Section>
  <Section v-else >
    <Carousel :settings="settings" :breakpoints="breakpoints">
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

export default defineComponent({
  components: {
    LawyerCard,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Section,
    CardSkeleton
  },
  created() {

    if (this.lawyers.length == 0) {
        this.getAllLawyers();
    }
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      lawyers: [],
      key:1,
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
    getAllLawyers() {
      axios.post(this.route('getApiLawyers')).then(res => {
        this.lawyers = res.data.data.data
      });
    },
    submit() {
    },
  },
  props: [
    'findLawyers',
  ],
  watch: {
    // refresh(newVal,oldVal){
    //     this.key ++
    // }
    }
});
</script>
