<template>
  <app-layout title="Dashboard">
    <template #header>
      <!-- <page-header>
                {{ __('broadcast') }}
            </page-header> -->
    </template>
    <template #default>
      <div class="py-5 border-bottom border-dark">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div
                v-if="
                  getPageContentType('media_page_description') == 'textarea'
                "
              >
                <div v-html="getPageContent('media_page_description')"></div>
              </div>
              <div
                v-else-if="
                  getPageContentType('media_page_description') == 'text'
                "
              >
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
      <div class="section py-5">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="wrapper">
                  <div class="w-100">
                    <h1 class="text-start text-capitalize mb-3">
                      {{ broadcast.name }}
                    </h1>
                    <div class="d-flex">
                      <div class="" style="word-break: break-all">

                        <div
                          class="mb-3"
                          v-if="broadcast.link_type == 'internal'"
                        >
                          <video
                            v-if="broadcast.file_type == 'video'"
                            width="400"
                            controls
                          >
                            <source :src="broadcast.video" />
                          </video>
                          <audio v-if="broadcast.file_type == 'audio'" controls>
                            <source :src="broadcast.audio" />
                          </audio>
                        </div>
                        <div v-else>
                          <iframe
                            width="420"
                            height="315"
                            class="image-c"
                            :src="broadcast.file_url"
                            style="float: left;"
                          >
                        </iframe>
                        <div class="mb-3" v-html="broadcast.description"></div>
                        </div>
                      </div>
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
  props: ["broadcast"],
  created() {},
  data() {
    return {
      broadcasts: {},
      breadcrums: [
        {
          id: 1,
          name: this.__('home'),
          link: "/",
        },
        {
          id: 2,
          name: this.__('explore'),
          link: "",
        },
      ],
    };
  },
});
</script>
