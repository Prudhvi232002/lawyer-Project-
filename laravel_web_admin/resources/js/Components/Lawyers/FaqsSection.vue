<template>
  <div class="section faqs-section pt-0" v-if="faqs.length > 0">
            <div class="container">

                <div class="row">
                    <div class="col-12 mb-5 text-center">
                        <div  v-if="getPageContentType('faqs_section_description') == 'textarea'">
                                      <div v-html="getPageContent('faqs_section_description')"> </div>
                                    </div>
                                <div  v-else-if="getPageContentType('faqs_section_description') == 'text'">
                                    <p> {{getPageContent('faqs_section_description') ?? '-'}} </p>
                            </div>
                            <div v-else>
                                <span class="fs-3">{{ __("Find some ") }}</span>
                        <h2 class="5">{{ __("Answer Questions") }}</h2>
                        <p>
                            When you choose Elite Legal Services, you are
                            choosing a trusted partner dedicated to your
                            success. Here are some frequently asked questions by
                            some users. Feel free to add your questions
                        </p>
                            </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item" v-for="item in faqs" :key="item.id">
                                <h2 class="accordion-header" :id="`panelsStayOpen-headingOne${item.id}`">
                                    <button class="accordion-button shadow-none collapsed mb-3" type="button"
                                        data-bs-toggle="collapse" :data-bs-target="`#panelsStayOpen-collapseOne${item.id}`"
                                        aria-expanded="false" :aria-controls="`panelsStayOpen-collapseOne${item.id}`">
                                        <div
                                            class="d-flex w-100 flex-column flex-lg-row align-items-lg-center justify-content-between px-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-question-circle me-3 fs-3"></i>
                                                <span>{{ item.name }}</span>
                                            </div>

                                        </div>
                                    </button>
                                </h2>
                                <div :id="`panelsStayOpen-collapseOne${item.id}`" class="accordion-collapse collapse"
                                    :aria-labelledby="`panelsStayOpen-headingOne${item.id}`">
                                    <div class="accordion-body">
                                        <div v-html="item.description"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-4 justify-content-center">
                    <div class="col-md-3 d-flex justify-content-center">
                        <Link href="#" class="learn-more btn position-relative">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <span class="button-text">{{
                            getPageContent('general_view_more_btn_text') ??
                            __("view more")
                        }}</span>
                        </Link>
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
    this.getFAQS();
  },
  data() {
    return {
      form: this.$inertia.form({}),
      faqs: [],
      top_rated_tab: false,
      featured_tab: true,
      all_lawyer_tab: false,
      top_rated_key: 1,
      featured_key: 1,
      all_lawyer_key: 1,
    };
  },
  methods: {
    getFAQS() {
            axios.get(this.route("getApiFaqs")).then((res) => {
                this.faqs = res.data.data;
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
<style scoped>
    .accordion-button:not(.collapsed) {
  color: var(--bs-primary) !important;
}
</style>
