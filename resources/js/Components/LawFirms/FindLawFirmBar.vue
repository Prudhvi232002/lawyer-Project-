<template>
  <div v-if="home">
    <div class="row">
        <form @submit.prevent="submit" >
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="input-group bg-white px-2 py-2  custom-search-panel">
                    <div class="d-flex align-items-center">
                        <!-- <span id="search_concept">
                          <i class="bi bi-search"></i>
                        </span> -->
                        <input
                        :placeholder="getPageContent('general_search_btn_text') ?? __('search')"
                          type="text"
                          class="border-0 py-2 ms-3 shadow-none search-field"
                          v-model="form.search"
                        id="findLawFirmHome"
                        />
                      </div>

                      <span class="d-flex align-items-center">
                        <button
                        :disabled="isLoading"
                        :href="route('law_firms.listing')"
                        class="btn btn-primary ms-3"
                        type="submit"
                      >
                      <SpinnerLoader v-if="isLoading" />
                      {{ getPageContent('general_search_btn_text') ?? __('search') }}
                      </button>

                      </span>
                    </div>
                    </div>
        </div>
        </form>
      <!-- <div class="col-md-4">
        <select
          v-model="form.law_firm_category"
          class="form-select border-0 py-3"
          aria-label="Select Category"
        >
          <option value selected>{{ __('select') }} {{ __('category') }}</option>
          <option v-for="cat in law_firm_categories" :key="cat.id" :value="cat.slug">{{ cat.name }}</option>
        </select>
      </div>
      <div class="col-md-4">
        <input
          type="text"
          class="form-control border-0 py-3"
          v-model="form.search"
          id="findLawFirmHome"
          :placeholder="__('search')"
        />
      </div> -->
      <!-- <div class="col-md-4">
        <div class="d-flex">
          <select
            v-model="form.country"
            class="form-select border-0 py-3"
            aria-label="Select Distance"
          >
            <option value selected>{{ __('select') }} {{ __('country') }}</option>
            <option
              v-for="country in countries"
              :key="country.id"
              :value="country.id"
            >{{ country.name }}</option>
          </select>

          <button
            :href="route('law_firms.listing')"
            @click="submit"
            class="btn btn-primary text-white border-0 ms-3 px-4"
            type="submit"
          >
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div> -->
    </div>
  </div>
  <div v-else class="section pt-4 pb-5">
    <div class="container">
      <div class="row pt-2">
        <div class="col-12">
          <h2>{{ __('find') }} {{ __n('law_firm') }}</h2>
        </div>
        <div class="col-12">
          <div class="row flex-column">
            <div class="col-md-4 w-100 mb-4 px-0">
              <select
                v-model="form.law_firm_category"
                class="form-select"
                aria-label="Select Category"
              >
                <option value selected>{{ __('select') }} {{ __('category') }}</option>
                <option
                  v-for="cat in law_firm_categories"
                  :key="cat.id"
                  :value="cat.slug"
                >{{ cat.name }}</option>
              </select>
            </div>
            <div class="col-md-4 w-100 mb-4 px-0">
              <input
                type="text"
                v-model="form.search"
                class="form-control"
                id="findLawFirmListing"
                :placeholder="__('search')"
              />
            </div>
            <div class="col-md-4 w-100 mb-4 px-0">
              <div class="d-flex">
                <select v-model="form.country" class="form-select" aria-label="Select Country">
                  <option value selected>{{ __('select') }} {{ __('country') }}</option>
                  <option
                    v-for="country in countries"
                    :key="country.id"
                    :value="country.id"
                  >{{ country.name }}</option>
                </select>
              </div>
            </div>

            <div class="col-12 px-0">
              <div class="d-grid">
                <button
                  :href="route('law_firms.listing')"
                  @click="submit"
                  class="btn btn-primary"
                  type="submit"
                  :disabled="isLoading"
                >
                <SpinnerLoader v-if="isLoading" />
                {{ __('search') }}
                </button>
                <button
                :disabled="isClearLoading"
                    @click="clearFilters"
                    class="btn btn-secondary mt-3"
                >
                <SpinnerLoader v-if="isClearLoading" />
                {{ __('clear') }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import axios from "axios";
import { router } from "@inertiajs/inertia-vue3";
export default defineComponent({
  components: {
    ValidationErrors,
    SpinnerLoader,
    Link
  },
  props: {
    is_redirect: {
      type: Boolean,
      default: true
    },
    home: {
      type: Boolean,
      default: false
    },
    is_law_firm_page: {
            type: Boolean,
            default: false,
        },
  },
  created() {

    if (this.is_law_firm_page) {
        this.getLawFirmCategories();
        this.getCountries();
        }
    this.$emit("getLawFirms", this.form);
  },
  data() {
    return {
      isLoading:false,
            isClearLoading:false,
      form: {
        law_firm_category: route().params.law_firm_category ?? "",
        search: route().params.search ?? "",
        country: route().params.country ?? ""
      },
      countries: [],
      law_firm_categories: []
    };
  },

  methods: {
    getLawFirmCategories() {
      axios.get(this.route("getApiLawFirmCategories")).then(res => {
        this.law_firm_categories = res.data.data;
      });
    },
    getCountries() {
      axios.get(this.route("getApiCountries")).then(res => {
        this.countries = res.data.data;
      });
    },
    submit() {
      this.$inertia.replace(this.route("law_firms.listing"), {
        data: this.form,
        replace: true,
        preserveScroll: true
      });
      this.$emit("getLawFirms", this.form);

      //   if (this.is_redirect) {
      //     this.$inertia.replace(this.route("law_firms.listing"), { data: this.form, replace: true });
      //   } else {
      //     this.$emit('getLawFirms', this.form)
      //   }
    },
    submit() {
            this.isLoading = true;
            const fetchDataPromise = new Promise((resolve, reject) => {
                setTimeout(() => {
                  this.$inertia.replace(this.route("law_firms.listing"), {
                    data: this.form,
                    replace: true,
                    preserveScroll: true
                  });
              this.$emit("getLawFirms", this.form);
                resolve();
                }, 1000);
            });
            fetchDataPromise
                .then((data) => {
                })
                .catch((error) => {
                })
                .finally(() => {
                this.isLoading = false;
                });
        },
        clearFilters() {
            this.isClearLoading = true;
            const fetchDataPromise = new Promise((resolve, reject) => {
                setTimeout(() => {
                  this.form.law_firm_category = "";
            this.form.search = "";
            this.form.country = "";
            this.$inertia.replace(this.route("law_firms.listing"));
            this.$emit("getLawFirms", this.form);
                resolve();
                }, 1000);
            });
            fetchDataPromise
                .then((data) => {
                })
                .catch((error) => {
                })
                .finally(() => {
                this.isClearLoading = false;
                });
        },
  }
});
</script>
