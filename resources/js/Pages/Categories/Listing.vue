<template>
  <app-layout title="Categories">
    <template #header></template>
    <div class="container-fluid py-5 border-bottom border-dark">
      <div class="row">
        <div class="col-12">
          <div
            v-if="
              getPageContentType('categories_page_description') == 'textarea'
            "
          >
            <div v-html="getPageContent('categories_page_description')"></div>
          </div>
          <div
            v-else-if="
              getPageContentType('categories_page_description') == 'text'
            "
          >
            <p>{{ getPageContent("categories_page_description") ?? "-" }}</p>
          </div>

          <div v-else>
            <h2 class="fs-2 text-center">
              <span class="fw-normal">Search Lawyer | </span>
              <span class="fw-bold">Make An Appointment</span>
            </h2>
            <!-- <p class="text-center mb-0">
                                        Discover The Best Lawyers Near You
                                    </p> -->
          </div>
          <breadcrums :breadcrums="breadcrums"></breadcrums>
        </div>
      </div>
      <!-- <div class="row pt-5">
                <div class="col-12 px-0">
                    <div
                        class="card rounded-0 border-0 p-4"
                        style="background-color: #262e39"
                    >
                        <div class="row justify-content-center">
                            <div
                                class="col-md-4"
                                v-if="form.search_type == 'country'"
                            >
                                <Multiselect
                                    v-model="form.country"
                                    :close-on-select="false"
                                    :searchable="true"
                                    :options="this.countries"
                                    valueProp="id"
                                    label="name"
                                    :placeholder="__('select country')"
                                    class="form-control p-0"
                                />
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary h-100">
                                   {{ getPageContent('general_search_btn_text') ?? Search }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
    </div>
    <div class="section p-0">
      <div class="container">
        <div class="row py-5 px-3 px-md-0">
          <div class="col-12 p-0">
            <div class="card rounded-0 border-0">
              <div class="row">
                <div v-if="fetching" class="row">
                  <div class="col-md-4">
                    <categories-skeleton></categories-skeleton>
                  </div>
                  <div class="col-md-4">
                    <categories-skeleton></categories-skeleton>
                  </div>
                  <div class="col-md-4">
                    <categories-skeleton></categories-skeleton>
                  </div>
                  <div class="col-md-4">
                    <categories-skeleton></categories-skeleton>
                  </div>
                  <div class="col-md-4">
                    <categories-skeleton></categories-skeleton>
                  </div>
                  <div class="col-md-4">
                    <categories-skeleton></categories-skeleton>
                  </div>
                </div>
                <div v-else
                  class="col-md-4"
                  v-for="(main_category, ind) in this.lawyer_main_categories"
                  :key="ind"
                >
                  <div
                    class="p-3 me-md-3 text-white bg-secondary text-secondary d-flex align-items-center rounded-5 mb-4"

                  >
                    <span class="me-3 text-white"
                      ><img
                        :src="main_category.icon"
                        style="width: 30px; max-height: 30px; filter: invert(1);"
                        alt="" /></span
                    ><a
                    href="#"
                      class="text-decoration-none text-white"
                    >
                      {{ main_category.name }}</a
                    >
                  </div>
                  <ul class="list-unstyled mb-3 me-3">
                    <li
                      class="fw-normal mb-2 category-hover"
                      v-for="(sub_cat, sub_ind) in main_category.categories"
                      :key="sub_ind"
                    >
                      <Link
                        class="text-decoration-none text-black "
                        :href="
                          route('lawyers.listing', {
                            lawyer_category: sub_cat.slug,
                            main_category_slug: main_category.slug,
                          })
                        "
                      >
                        {{ sub_cat.name }}
                      </Link>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { router } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import CategoriesSkeleton from "@/Components/Skeleton/CategoriesSkeleton.vue";
import VueGoogleAutocomplete from "vue-google-autocomplete";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
export default defineComponent({
  components: {
    ValidationErrors,
    Link,
    Multiselect,
    VueGoogleAutocomplete,
    AppLayout,
    Breadcrums,
    CategoriesSkeleton,
  },
  props: {
    is_redirect: {
      type: Boolean,
      default: true,
    },
  },
  created() {
    this.getLawyerMainCategories();
    // this.getCountries();
  },
  data() {
    return {
      form: {
        lawyer_category: route().params.lawyer_category ?? "",
        search: route().params.search ?? "",
        country: route().params.country ?? "",
        location:
          route().params.search_type == "location" && route().params.location
            ? route().params.location
            : "",
        latitude: route().params.latitude ?? "",
        longitude: route().params.longitude ?? "",
        search_type: route().params.search_type ?? "country",
        distance:
          route().params.search_type == "distance" && route().params.distance
            ? route().params.distance
            : "",
        zip_code:
          route().params.search_type == "zip_code" && route().params.zip_code
            ? route().params.zip_code
            : "",
      },
      countries: [],
      lawyer_categories: [],
      lawyer_main_categories: [],
      distanceOptions: [],
      fetching:true,
      breadcrums: [
        {
          id: 1,
          name: this.__('home'),
          link: "/",
        },
        {
          id: 2,
          name: this.__('Categories'),
          link: "",
        },
      ],
    };
  },
  async mounted() {
    await this.locatorButtonPressed();
    if (route().params.search) {
      this.$refs.address.update(route().params.search ?? "");
      if (!this.form.location) {
        this.$refs.address.focus();
        this.form.latitude = this.location_data.lat ?? "";
        this.form.longitude = this.location_data.lng ?? "";
      }
    }

    this.formDistanceOptions();
  },
  methods: {
    // getLawyerCategories() {
    //   axios.get(this.route("getApiLawyerCategories")).then((res) => {
    //     this.lawyer_categories = res.data.data;
    //   });
    // },
    getLawyerMainCategories() {
      axios.get(this.route("getApiLawyerMainCategories")).then((res) => {
        this.lawyer_main_categories = res.data.data;
        this.fetching = false;
      });
    },
    getCountries() {
      axios.get(this.route("getApiCountries")).then((res) => {
        this.countries = res.data.data;
      });
    },

    async formDistanceOptions() {
      var options = [
        { value: "", name: this.__("select distance") },
        // { value: "all", name: this.__("select all") },
      ];
      for (let i = 1; i < 1000; i++) {
        var obj = { value: i, name: i + " km" };
        options.push(obj);
      }
      this.distanceOptions = options;
    },

    updateLocation(address) {
      this.form.location = address.newVal;
    },

    async getCurrentLocation() {
      this.form.latitude = this.location_data.lat ?? "";
      this.form.longitude = this.location_data.lng ?? "";
      if (this.form.latitude && this.form.longitude) {
        var user_address = await this.getStreetAddressFrom(
          this.form.latitude,
          this.form.longitude
        );
        this.$refs.address.update(user_address);
      }
    },

    getAddressData: function (addressData, placeResultData, id) {
      this.form.latitude = addressData.latitude;
      this.form.longitude = addressData.longitude;
      this.form.location = addressData.route;
      // this.address = addressData;
    },
  },
});
</script>
