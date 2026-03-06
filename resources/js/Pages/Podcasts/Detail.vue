<template>
  <app-layout title="podcast">
    <template #default>
      <div class="py-5 border-bottom border-dark">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div
                v-if="
                  getPageContentType('podcasts_page_description') == 'textarea'
                "
              >
                <div v-html="getPageContent('podcasts_page_description')"></div>
              </div>
              <div
                v-else-if="
                  getPageContentType('podcasts_page_description') == 'text'
                "
              >
                <p>{{ getPageContent("podcasts_page_description") ?? "-" }}</p>
              </div>
              <div v-else>
                <h2 class="fs-2 text-center">
                  <span class="fw-normal">{{__('explore') }}| </span>
                  <span class="fw-bold">{{__('all podcast') }}</span>
                </h2>
                <!-- <p class="text-center mb-0">Discover The Best Lawyers Near You</p> -->
              </div>

              <breadcrums :breadcrums="breadcrums"></breadcrums>
            </div>
          </div>
        </div>
      </div>
      <div class="section py-5">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="" style="height: 450px">
                    <img
                      v-if="podcast.image"
                      class="img-fluid w-100 rounded"
                      :src="podcast.image"
                      alt="image"
                      style="height: 450px; object-fit: cover"
                    />
                    <img
                      v-else
                      class="img-fluid w-100 rounded"
                      src="@/images/common/podcast.png"
                      alt="image"
                      style="height: 450px; object-fit: cover"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <h1 class="text-start text-capitalize">{{ podcast.name }}</h1>
                  <div class="mb-3" v-html="podcast.description"></div>
                  <div class="d-flex justify-content-center">
                    <div v-if="podcast.link_type == 'internal'">
                      <video
                        v-if="podcast.file_type == 'video'"
                        width="400"
                        controls
                      >
                        <source :src="podcast.video" />
                      </video>
                      <audio v-if="podcast.file_type == 'audio'" controls>
                        <source :src="podcast.audio" />
                      </audio>
                    </div>
                    <div v-else>
                      <iframe width="420" height="315" :src="podcast.file_url">
                      </iframe>
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
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    Breadcrums,
  },
  props: ["podcast"],
  created() {},
  data() {
    return {
      posts: {},
      breadcrums: [
        {
          id: 1,
          name :this.__('home'),
          link: "/",
        },
        {
          id: 2,
         name :this.__('podcast'),
          link: "",
        },
      ],
    };
  },
});
</script>
