<template>
  <div v-if="featured_law_firms.length > 0" class="section py-5 bg-light spotlight">
    <div class="container">

      <div class="row">
        <div class="col-12">
          <div class="position-relative">
            <h2 class="text-center">{{ __('Featured LawFirm') }}</h2>
            <p class="text-center mb-4">Discover who is Featured LawFirm this week. We are a community of knowledgeable, established, Global LawFirms, Conscious Event Facilitators and Holistic LawFirms from around the world. Connect with some of our most highly recommended and well established law_firms in the GHCN.</p>
            <!-- <div class="position-absolute top-0" style="right: 15%;">

              <button @click="prev" class="btn">
                <i class="bi bi-chevron-left"></i>
              </button>
              <button @click="next" class="btn">
                <i class="bi bi-chevron-right"></i>
              </button>
            </div> -->
          </div>
        </div>
      </div>

    <div class="container-fluid spotlight-carousel px-0">
      <Carousel :items-to-show="1" :wrap-around="true" ref="carousel" v-model="currentSlide">
        <Slide v-for="law_firm in featured_law_firms" :key="law_firm.id">
          <!-- <law-firm-spotlight-card :law_firm="law_firm"></law-firm-spotlight-card> -->
        <law-firm-card :law_firm="law_firm"></law-firm-card>

        </Slide>
        <template #addons>
            <Navigation />
        </template>
      </Carousel>
    </div>
      <!-- <div class="row pt-4 justify-content-center">
        <div class="col-md-3 d-flex justify-content-center">
          <Link :href="route('law_firms.listing')" class="btn rounded-5 border-0 px-4 text-white btn-primary">{{ __('view all law_firms') }}</Link>
        </div>
      </div> -->
    </div>
  </div>
  <div v-else>

  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import LawFirmSpotlightCard from "@/Components/LawFirms/LawFirmSpotlightCard.vue";
import LawFirmCard from "@/Components/LawFirms/LawFirmCard.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';

export default defineComponent({
  components: {
    LawFirmSpotlightCard,
    LawFirmCard,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation
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
        itemsToShow:1,
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

    next() {
      this.$refs.carousel.next()
    },
    prev() {
      this.$refs.carousel.prev()
    },
  },
});
</script>

