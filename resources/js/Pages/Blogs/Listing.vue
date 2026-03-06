<template>
    <app-layout title="My Profile">
        <template #header></template>

        <div class="py-5 border-bottom border-dark">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div v-if="getPageContentType('blogs_page_description') == 'textarea'
                            ">
                            <div v-html="getPageContent('blogs_page_description')"></div>
                        </div>
                        <div v-else-if="getPageContentType('blogs_page_description') == 'text'
                            ">
                            <p>{{ getPageContent("blogs_page_description") ?? "-" }}</p>
                        </div>
                        <div v-else>

                            <h2 class="fs-2 text-center">
                                <span class="fw-normal">{{ __('explore') }} | </span>
                                <span class="fw-bold">{{__('all blog') }}</span>
                            </h2>
                            <!-- <p class="text-center mb-0">Discover The Best Lawyers Near You</p> -->
                        </div>

                        <breadcrums :breadcrums="breadcrums"></breadcrums>
                    </div>
                </div>
            </div>
        </div>




        <div class="section py-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="search-side-bar">
                            <find-post-bar @getPosts="onSearch" :is_redirect="false"></find-post-bar>
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

                                <div v-if="posts.data.length > 0" class="row">
                                    <post-card :add_col="false" v-for="post in posts.data" :key="post.id"
                                        :post="post"></post-card>
                                </div>
                                <div v-else class="row">
                                    <div class="col-12 text-center mb-3">
                                        <record-not-found></record-not-found>
                                    </div>
                                </div>
                                <div class="row my-4" v-if="posts.meta.last_page != this.filter.page">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <button @click="loadMore()"
                                            class="btn btn-primary  position-relative"
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
import FindPostBar from "@/Components/Posts/FindPostBar.vue";
import PostCard from "@/Components/Posts/PostCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";


export default defineComponent({
    mixins: [PaginationMixin],
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        FindPostBar,
        PostCard,
        RecordNotFound,
        Breadcrums,
        CardSkeleton
    },
    created() {
    },
    data() {
        return {
            posts: {},
            breadcrums:[
                {
                    id:1,
                    name:this.__('home'),
                    link:'/'
                },
                {
                    id:2,
                    name:this.__('blog'),
                    link:''
                }
            ]
        }
    },
    methods: {
        async getPaginatedData(loading_more = false) {
            await this.getPosts(loading_more)
        },
        getPosts(loading_more) {
            // if(Object.keys(route().params).length > 0){
            //     this.$inertia.replace(route('blogs.listing'))
            // }
            axios.post(this.route('getApiPosts'), this.filter).then(res => {
                const data = res.data.data
                if (loading_more) {
                    this.posts.data = this.posts.data.concat(data.data);
                } else {
                    this.posts.data = data.data;
                }
                this.posts.links = data.links
                this.posts.meta = data.meta
                this.fetching = false
            });
        },

    },
});
</script>
