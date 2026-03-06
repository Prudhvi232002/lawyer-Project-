<template>
    <div class="section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2>{{ __('rating and reviews') }}</h2>
                        <Link :href="route('law_firm.reviews', { user_name: law_firm.user_name })">{{ __('view all') }}</Link>
                    </div>
                </div>

                <div class="col-12 mb-5">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="rating fs-3 text-warning" v-if="law_firm.rating > 0">
                                        <h2 class="display-3 mb-0 lh-1 text-primary">{{ law_firm.rating }}/5</h2>
                                        <star-rating :rating="law_firm.rating" :star-size="25" :read-only="true"
                                            :increment="0.01" :show-rating="false"></star-rating>
                                    </div>

                                </div>
                                <div class="col-md-7">
                                    <ul class="user-rating">
                                        <li v-for="(rating, i) in rating_group_keys" :key="i">
                                            <div class="rating">
                                                <star-rating :rating="rating" :star-size="18" :read-only="true"
                                                    :increment="0.01" :show-rating="false"></star-rating>
                                            </div>
                                            <div class="progress mx-3" role="progressbar" aria-label="rating-bar"
                                                :aria-valuenow="rating" aria-valuemin="0" aria-valuemax="5">
                                                <div class="progress-bar bg-warning"
                                                    :style="{ 'width': rating * 20 + '%' }">
                                                </div>
                                            </div>
                                            <span>{{ rating_groups[rating].length }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div v-if="$page.props.auth && $page.props.auth.user.email_verified_at && $page.props.auth.logged_in_as == 'customer'"
                            class="col-md-5 d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#RatingModal">{{ __('write a review') }}</button>
                        </div>
                        <!-- <div v-else class="col-md-5 d-flex justify-content-end">
                                <Link :href="route('login')" class="btn btn-primary text-white border-0" >{{ __('write a review') }}</Link>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row" v-if="reviews.length > 0">
                        <Carousel :items-to-show="4" ref="carousel" v-model="currentSlide">
                            <Slide v-for="review in reviews" :key="review.id">
                                <law-firm-review-card :review="review"></law-firm-review-card>
                            </Slide>
                            <template #addons>
                                <Navigation />
                            </template>
                        </Carousel>
                    </div>
                    <div v-else class="row">
                        <div class="col-12">
                            {{ __('no review found') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <add-review-modal :law_firm_id="law_firm_id"></add-review-modal>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import LawFirmReviewCard from "@/Components/LawFirms/LawFirmReviewCard.vue";
import AddReviewModal from "@/Components/LawFirms/AddReviewModal.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';

export default defineComponent({
    components: {
        LawFirmReviewCard,
        AddReviewModal,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation
    },
    created() {
        // group by rating
        this.rating_groups = this.reviews.reduce((x, y) => {
            (x[y.rating] = x[y.rating] || []).push(y);
            return x;
        }, {});

        this.rating_group_keys = Object.keys(this.rating_groups).sort((a, b) => b.localeCompare(a));

    },
    props: ['reviews', 'law_firm', 'law_firm_id'],
    data() {
        return {
            rating_groups: [],
            rating_group_keys: [],
            form: this.$inertia.form({
            }),
            featured_law_firms: [],
            settings: {
                itemsToShow: 4,
                snapAlign: 'start',
            },
            // breakpoints are mobile first
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 4,
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

