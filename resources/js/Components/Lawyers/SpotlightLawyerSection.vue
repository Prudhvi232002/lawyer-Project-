<template>
    <div class="section bg-light spotlight">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="position-relative text-center">
                        <img src="@/images/home/premium.png" alt="" class="img-fluid mb-3" />
                        <div class="col-12" v-if="getPageContentType('premium_lawyers_description') == 'textarea'">
                                      <div v-html="getPageContent('premium_lawyers_description')"> </div>
                                    </div>
                        <div class="col-12" v-else-if="getPageContentType('premium_lawyers_description') == 'text'">
                            <p> {{getPageContent('premium_lawyers_description') ?? '-'}} </p>
                    </div>
                    <div v-else>
                        <h2 class="text-center display-6">
                            {{ __("Premium Lawyers") }}
                        </h2>

                        <p class="text-center mb-5">
                            Our team of highly skilled attorneys comprises seasoned professionals with extensive experience
                            in their respective fields. We pride ourselves on recruiting top legal talent, ensuring that you
                            receive the highest standard of representation. From complex litigation to intricate
                            transactional matters, we have the depth of knowledge and breadth of skills to handle even the
                            most challenging cases.
                        </p>
                    </div>

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

            <div class="container-fluid spotlight-carousel px-0" v-if="!fetching && premium_lawyers.length > 0">
                <Carousel :items-to-show="1" ref="carousel" v-model="currentSlide">
                    <Slide v-for="lawyer in premium_lawyers" :key="lawyer.id">
                        <lawyer-spotlight-card :lawyer="lawyer"></lawyer-spotlight-card>
                    </Slide>
                    <template #addons>
                        <Pagination />
                    </template>
                </Carousel>
            </div>
            <Section v-else-if="!fetching && premium_lawyers.length == 0">
                <record-not-found></record-not-found>
            </Section>
            <div class="container-fluid spotlight-carousel px-0" v-else>
                <Carousel :items-to-show="1" :wrap-around="true" ref="carousel">
                    <Slide v-for="slide in 4" :key="slide">
                        <spotlight-card-skeleton class="px-md-5"></spotlight-card-skeleton>
                    </Slide>
                </Carousel>
            </div>

            <!-- <div class="row pt-4 justify-content-center">
          <div class="col-md-3 d-flex justify-content-center">
            <Link :href="route('lawyers.listing')" class="btn rounded-5 border-0 px-4 text-white btn-primary">{{ __('view all lawyers') }}</Link>
          </div>
        </div> -->
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import LawyerSpotlightCard from "@/Components/Lawyers/LawyerSpotlightCard.vue";
import axios from "axios";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import RecordNotFound from "../Shared/RecordNotFound.vue";

export default defineComponent({
    components: {
        LawyerSpotlightCard,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation,
        SpotlightCardSkeleton,
        RecordNotFound,
    },
    created() {
        this.getFeaturedLawyers();
    },
    data() {
        return {
            form: this.$inertia.form({}),
            premium_lawyers: [],
            fetching:true,
        };
    },
    methods: {
        getFeaturedLawyers() {
            axios.get(this.route("getApiPremiumLawyers")).then((res) => {
                this.fetching = false
                this.premium_lawyers = res.data.data;
            });
        },
        submit() { },

        next() {
            this.$refs.carousel.next();
        },
        prev() {
            this.$refs.carousel.prev();
        },
    },
});
</script>
