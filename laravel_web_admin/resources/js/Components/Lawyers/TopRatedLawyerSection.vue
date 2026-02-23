<template>
    <Section v-if="!fetching && top_rated_lawyers.length > 0">
      <!-- <template #paragraph>
        <p class="text-center mb-4">The Top Rated section highlights positive healing professionals and law_firms  who have built a strong reputation on the GHCN platform. All ratings are 100% user generated, these lawyers represent some of the top talent in this global community. Top rated lawyers have the highest positive feedback from other users like yourself, time after time. Each lawyer has been highly rated for their well rounded skills, compassion, support, and ability to help transform the lives of their clients.</p>
      </template> -->
        <Carousel :key="key" :settings="settings" :breakpoints="breakpoints">
              <Slide v-for="lawyer in top_rated_lawyers" :key="lawyer.id">
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
    <Section v-else-if="!fetching && top_rated_lawyers.length == 0">
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
import {  Link } from "@inertiajs/inertia-vue3";
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
  created(){

    if(this.top_rated_lawyers.length == 0)
    {
        this.getTopRatedLawyers()
    }
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      top_rated_lawyers:[],
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
    getTopRatedLawyers(){
        axios.get(this.route('getApiTopRatedLawyers')).then(res => {
                this.fetching = false
                this.top_rated_lawyers = res.data.data
            });
    },
    submit() {
    },
  },
  props:['refresh'],
  watch: {
    refresh(newVal,oldVal){
        this.key ++
    }
    }
});
</script>
