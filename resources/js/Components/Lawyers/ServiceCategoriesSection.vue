<template>
   <div class="p-6 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1>{{ ("Quick Buy Services") }}</h1>
                    <p class="mx-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since
                        Lorem Ipsum has been the industry's standard dummy text ever since
                    </p>
                </div>
            </div>
        </div>
        <div class="row py-4">
            <!-- Loop through service categories -->
            <div class="col-md-4" v-for="category in serviceCategories" :key="category.id">
                <div class="card border-0 mx-2 mb-3 mb-md-0">
                    <div class="rounded-5 overflow-hidden image-container">
                    <img v-if="category.image" class="image" :src="category.image" alt="categoryimg" >
                    <img v-else class="image" src="@/images/cardlaw.jpg" alt="categoryimg">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-5 text-black mb-0">{{ category.name }}</h3>
                            <star-rating
                            :rating="category.rating"
                            :star-size="18"
                            :read-only="true"
                            :increment="0.01"
                            :show-rating="false"
                        ></star-rating>
                        </div>
                        <p class="fs-6 mt-3 fw-regular text-black lineclamp-2" v-html="category.description"></p>
                        <Link :href="route('services.listing',{'service_category':category.slug})" class="btn btn-primary px-5 rounded-3 fw-bolder">{{ __("explore") }}</Link>
                    </div>
                </div>
            </div>
            <!-- End loop -->
        </div>
        <div class="row pt-4 justify-content-center">
      <div class="col-md-3 d-flex justify-content-center">
        <Link :href="route('services.listing')" class="learn-more btn position-relative" style="width:14rem">
            <span class="circle" aria-hidden="true">
              <span class="icon arrow"></span>
            </span>
            <span class="button-text">{{  getPageContent('general_view_more_btn_text') ??  __('view more') }}</span>
          </Link>
        <!-- <Link :href="route('law_firms.listing')" class="btn rounded-5 border-0 px-4 text-white btn-primary">{{ __('view more') }}</Link> -->
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
    this.getServiceCategories();
  },
  data() {
    return {
      form: this.$inertia.form({}),
      serviceCategories: [],
      top_rated_tab: false,
      featured_tab: true,
      all_lawyer_tab: false,
      top_rated_key: 1,
      featured_key: 1,
      all_lawyer_key: 1,
    };
  },
  methods: {
    getServiceCategories() {
            axios.get(this.route("getApiServiceCategories")).then((res) => {
                console.log(res.data.data);
                this.serviceCategories = res.data.data;
            });
        },
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
