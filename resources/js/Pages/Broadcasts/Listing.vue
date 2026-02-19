<template>
    <app-layout title="My Profile">
        <template #header> </template>
        <div class="py-5 border-bottom border-dark">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div v-if="getPageContentType('media_page_description') == 'textarea'
                            ">
                            <div v-html="getPageContent('media_page_description')"></div>
                        </div>
                        <div v-else-if="getPageContentType('media_page_description') == 'text'
                            ">
                            <p>{{ getPageContent("media_page_description") ?? "-" }}</p>
                        </div>
                        <div v-else>

                            <h2 class="fs-2 text-center">
                                <span class="fw-normal">{{__('explore') }}| </span>
                                <span class="fw-bold">{{__('all media') }}</span>
                            </h2>
                            <!-- <p class="text-center mb-0">Discover The Best Lawyers Near You</p> -->
                        </div>

                        <breadcrums :breadcrums="breadcrums"></breadcrums>
                    </div>
                </div>
            </div>
        </div>


        <div class="section p-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="search-side-bar py-4">
                            <find-broadcast-bar @getBroadcasts="onSearch" :is_redirect="false"></find-broadcast-bar>
                        </div>
                    </div>

                    <div class="col-md-9 border-start border-dark">

                        <div class="row mx-0 mt-4">


                            <div class="col-12" v-if="fetching">
                                <div class="row media-skeleton-cards">
                                    <div class="col-md-6 mb-4">
                                        <card-skeleton></card-skeleton>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <card-skeleton></card-skeleton>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <card-skeleton></card-skeleton>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <card-skeleton></card-skeleton>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" v-if="!fetching">
                                <div v-if="broadcasts.data.length > 0" class="row">
                                    <broadcast-card :add_col="true" v-for="broadcast in broadcasts.data" :key="broadcast.id"
                                        :broadcast="broadcast"></broadcast-card>
                                </div>
                                <div v-else class="row">
                                    <div class="col-12 text-center mb-3">
                                        <record-not-found></record-not-found>
                                    </div>
                                </div>
                                <div class="row my-4" v-if="broadcasts.meta.last_page != this.filter.page">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <button @click="loadMore()" class="btn btn-primary position-relative"
                                            :disabled="loading_more"><span :class="{
                                                'loader': loading_more
                                            }" class="position-absolute"></span> {{ __('load more') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import FindBroadcastBar from "@/Components/Broadcasts/FindBroadcastBar.vue";
import BroadcastCard from "@/Components/Broadcasts/BroadcastCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";



export default defineComponent({
    mixins: [PaginationMixin],
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        BroadcastCard,
        FindBroadcastBar,
        RecordNotFound,
        Breadcrums,
        CardSkeleton
    },
    created() {
    },
    data() {
        return {
            broadcasts: {},
            breadcrums: [
                {
                    id: 1,
                    name: this.__('home'),
                    link: '/'
                },
                {
                    id: 2,
                    name: this.__('media'),
                    link: ''
                }
            ]
        }
    },
    methods: {
        async getPaginatedData(loading_more = false) {
            await this.getBroadcasts(loading_more)
        },
        getBroadcasts(loading_more) {
            // if(Object.keys(route().params).length > 0){
            //     this.$inertia.replace(route('broadcasts.listing'))
            // }
            axios.post(this.route('getApiBroadcasts'), this.filter).then(res => {
                const data = res.data.data
                if (loading_more) {
                    this.broadcasts.data = this.broadcasts.data.concat(data.data);
                } else {
                    this.broadcasts.data = data.data;
                }
                this.broadcasts.links = data.links
                this.broadcasts.meta = data.meta
                this.fetching = false
            });
        },

    },
});
</script>
