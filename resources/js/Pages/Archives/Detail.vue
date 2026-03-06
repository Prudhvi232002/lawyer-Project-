<template>
  <app-layout title="course">
    <template #default>
      <div class="py-5 border-bottom border-dark">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div
                v-if="
                  getPageContentType('archives_page_description') == 'textarea'
                "
              >
                <div v-html="getPageContent('archives_page_description')"></div>
              </div>
              <div
                v-else-if="
                  getPageContentType('archives_page_description') == 'text'
                "
              >
                <p>{{ getPageContent("archives_page_description") ?? "-" }}</p>
              </div>
              <div v-else>
                <h2 class="fs-2 text-center">
                  <span class="fw-normal">{{ __('explore') }}| </span>
                  <span class="fw-bold">{{ __('all archive') }}</span>
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
            <div class="col-md-12">
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="" style="height: 450px">
                    <img
                      v-if="archive.image"
                      class="img-fluid w-100 rounded"
                      :src="archive.image"
                      alt="image"
                      style="height: 450px; object-fit: cover"
                    />
                    <img
                      v-else
                      class="img-fluid"
                      src="@/images/common/course.png"
                      alt="image"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <h1 class="text-capitalize text-start mb-3">
                    {{ archive.name }}
                  </h1>
                  <div class="" v-html="archive.description"></div>
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
    Breadcrums,
    PageHeader,
  },
  props: ["archive"],
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
                    name:this.__('archive'),
                    link:''
                }
            ]
        }
    },
});
</script>
