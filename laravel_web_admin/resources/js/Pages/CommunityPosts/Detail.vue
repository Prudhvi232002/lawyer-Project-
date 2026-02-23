<template>
  <app-layout title="Community Form">
    <template #header>
      <div class="py-5" style="background: #f4f4f4">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div
                class="trending-post overflow-hidden mb-4"
                v-if="community_post.image"
              >
                <img
                  :src="community_post.image"
                  class="img-fluid w-100"
                  alt=""
                />
              </div>
              <div
                class="trending-post overflow-hidden mb-4"
                v-else-if="community_post.video"
              >
                <video
                  v-if="community_post.video"
                  controls
                  autoplay
                  loop
                  class="video-fluid w-100 h-100"
                >
                  <source :src="community_post.video" type="video/mp4" />
                  Your browser does not support this video
                </video>
              </div>
              <div class="trending-post overflow-hidden mb-4" v-else>
                <img
                  src="@/images/home/user.png"
                  class="img-fluid w-100"
                  alt=""
                />
              </div>

              <p class="fs-4 fw-normal">
                {{ community_post.description }}
              </p>
            </div>
            <div class="col-md-12 mt-5">
              <h1 class="display-6 fw-bold text-black mb-4">
                {{ __("Related to trending Posts") }}
              </h1>
              <div class="row">
                <div
                  class="col-md-4"
                  v-for="trending_post in trending_posts.splice(0, 6)"
                  :key="trending_post.id"
                >
                  <div class="card radius-20 border-0 shadow me-3 me-md-0 mb-3">
                    <div class="portal-img" v-if="trending_post.image">
                      <img
                        :src="trending_post.image"
                        class="img-fluid w-100 h-100"
                        :alt="trending_post.image"
                      />
                    </div>
                    <div class="portal-img" v-else>
                      <img
                        src="@/images/home/pic2.png"
                        class="img-fluid w-100 h-100"
                        alt=""
                      />
                    </div>
                    <div class="card-body text-start px-md-4">
                      <p
                        class="fs-6 fw-normal text-black opacity-50 lineclamp-3"
                      >
                        {{ trending_post.description }}
                      </p>
                      <Link
                        :href="
                          trending_post.slug
                            ? route('community_post.detail', {
                                slug: trending_post.slug,
                              })
                            : '#'
                        "
                        class="text-primary text-decoration-none fs-6 fw-medium"
                        :class="{ 'disabled-link': !trending_post.slug }"
                      >
                        {{
                          trending_post.slug
                            ? __("View Details")
                            : __("Unavailable")
                        }}
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </app-layout>
</template>




<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default defineComponent({
  components: {
    AppLayout,
    PageHeader,
    Link,
  },
  data() {
    return {
      trending_posts: [],
    };
  },
  props: ["community_post"],
  created() {
    this.getTrendingCommunityPosts();
  },
  methods: {
    getTrendingCommunityPosts() {
      axios.get(this.route("getApiTrendingCommunityPosts")).then((res) => {
        this.trending_posts = res.data.data;
      });
    },
  },
});
</script>
