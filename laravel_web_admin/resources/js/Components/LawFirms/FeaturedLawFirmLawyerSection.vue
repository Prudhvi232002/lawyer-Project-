<template>
    <div v-if="law_firm_lawyers.length > 0">
        <Carousel :key="key" :settings="settings" :breakpoints="breakpoints">
            <Slide v-for="lawyer in law_firm_lawyers" :key="lawyer.id">
                <lawyer-card :lawyer="lawyer"></lawyer-card>
            </Slide>
        </Carousel>
    </div>
    <div v-else>
        <div class="row lawyer-lawfirm">
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import LawyerCard from "@/Components/Lawyers/LawyerCard.vue";
import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
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
        CardSkeleton,
    },
    created() {
    },
    data() {
        return {
            form: this.$inertia.form({}),
            featured_lawyers: [],
            key: 1,
            settings: {
                itemsToShow: 1,
                snapAlign: "start",
                autoplay: false,
            },
            // breakpoints are mobile firstTop Featured Lawyers
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 2,
                    snapAlign: "start",
                },
                // 1024 and up
                1024: {
                    itemsToShow: 2,
                    snapAlign: "start",
                },
                1240: {
                    itemsToShow: 4,
                    snapAlign: "start",
                }
            },
        };
    },
    methods: {
        submit() {},
    },
    props: ["findLawyers", "refresh","law_firm_lawyers"],
    watch: {
        refresh(newVal, oldVal) {
            this.key++;
        },
    },
});
</script>
