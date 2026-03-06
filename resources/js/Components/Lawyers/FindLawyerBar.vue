<template>
    <div v-if="home">
        <div class="row">
            <div class="col-12">
                <div
                    class="d-flex align-items-center w-100"
                >
                <form @submit.prevent="submit" >
                    <div
                        class="input-group bg-white px-2 py-2  custom-search-panel"
                    >
                        <div class="d-flex align-items-center">
                            <input
                                type="text"
                                class="border-0 py-2 ms-3 shadow-none search-field"
                                v-model="form.search"
                                id="findLawyerHome"
                                :placeholder="getPageContent('general_search_btn_text') ?? __('search')"
                            />
                        </div>

                        <span class="d-flex align-items-center">
                            <button
                                :href="route('lawyers.listing')"
                                :disabled="isLoading"
                                class="btn btn-primary ms-3"
                                type="submit"
                            >
                            <SpinnerLoader v-if="isLoading" />
                                {{ getPageContent('general_search_btn_text') ?? __('search') }}
                            </button>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="section pt-4 pb-5">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12 p-0">
                    <div
                        class="card rounded-0 mb-4 py-3" style="background-color: #f8f8f8;"

                    >
                        <div class="px-3">
                            <h5 class="mb-3">
                                {{ __("find") }} {{ __n("lawyer") }}
                            </h5>
                        </div>
                        <div class="cat-card mb-3" style="

max-height: 400px;
overflow: auto;
">
    <div class="px-3">

        <h5 class="mb-3">
            {{ __("select") }} {{ __n("category") }}
        </h5>

            <!-- <Multiselect @change="lawyerCategoryChange" v-model="form.lawyer_category" valueProp="slug" label="name"
            groupLabel="name" groupOptions="categories" :groupSelect="true" :groups="true" :close-on-select="false"
            :searchable="true" :options="this.lawyer_main_categories" class="mb-3" :placeholder="__('select category')" /> -->

                        <div  class="accordion bg-transparent " id="accordionExample" >
                            <!-- <div class="accordion-item bg-transparent" v-for="(main_category, ind) in this.lawyer_main_categories"
                            :key="ind">
                            <h2 class="accordion-header bg-transparent" id="headingOne">
                                <button class="accordion-button shadow-none py-2 px-1 fw-bold rounded-0 bg-transparent border-bottom " :class="form.lawyer_category == main_category.slug ?'' : 'collapsed'" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapseOne'+ind" aria-expanded="true" aria-controls="collapseOne">
                                {{ main_category.name}}
                                </button>
                            </h2>
                            <div :id="'collapseOne'+ind" class="accordion-collapse collapse" :class="form.lawyer_category == main_category.slug ?'show' : ''" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li class="py-2 border-bottom" v-for="(sub_cat, sub_ind) in main_category.categories"
                                    :key="sub_ind">
                                    <input :key="sub_ind" @change="lawyerCategoryChange(sub_ind.slug)" v-model="form.lawyer_category" class="form-check-input" type="checkbox" :true-value="sub_ind.slug" false-value="" :value="sub_ind.slug" :id="sub_ind.slug">
                                    <label class="form-check-label" :for="sub_cat.slug">
                                        {{ sub_cat.name ?? "" }}
                                    </label>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            </div> -->
                            <div v-for="(main_category,index) in lawyer_main_categories" :key="index" class="accordion-item bg-transparent">
                                <h2 class="accordion-header">
                                <button class="accordion-button shadow-none py-2 px-1 fw-bold rounded-0 bg-transparent border-bottom" :class="lawyer_category_selected == main_category.slug ?'' : 'collapsed'" type="button" data-bs-toggle="collapse" :data-bs-target="`#collapseOne${main_category.slug}`"
                                :aria-expanded=" index > 0 ? false : true" aria-controls="collapseOne">
                                    {{ main_category.name ?? "" }}
                                </button>
                                </h2>
                                <div :id="`collapseOne${main_category.slug}`" class="accordion-collapse collapse" :class="lawyer_category_selected == main_category.slug ?'show' : ''" >
                                <div class="accordion-body">
                                    <div v-for="(category,innerIndex) in main_category.categories" class="form-check" :key="innerIndex">
                                    <input :key="innerIndex" @change="lawyerCategoryChange(category.slug)" v-model="form.lawyer_category" class="form-check-input" type="checkbox" :true-value="category.slug" false-value="" :value="category.slug" :id="category.slug">
                                    <label class="form-check-label" :for="category.slug">
                                        {{ category.name ?? "" }}
                                    </label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>
                        <div class="card-body p-0">
                            <div class="px-3">
                                <div class="w-100 mb-3">
                                    <input
                                        type="text"
                                        v-model="form.search"
                                        class="form-control"
                                        id="findLawyerListing"
                                        :placeholder="__('search')"
                                    />
                                </div>
                                <div>
                                    <Multiselect
                                        v-model="form.search_type"
                                        @change="searchTypeChanged"
                                        :close-on-select="true"
                                        :searchable="true"
                                        :options="[
                                            {
                                                value: 'country',
                                                name: `${__(
                                                    'search by country'
                                                )}`,
                                            },
                                            {
                                                value: 'distance',
                                                name: `${__('distance')}`,
                                            },
                                            {
                                                value: 'location',
                                                name: `${__('location')}`,
                                            },
                                            {
                                                value: 'zip_code',
                                                name: `${__('zip_code')}`,
                                            },
                                        ]"
                                        valueProp="value"
                                        label="name"
                                        :placeholder="__('select search type')"
                                        class="form-control p-0 mb-3"
                                    />
                                </div>
                                <div
                                    class="mb-3 mb-md-0 d-flex flex-column align-items-center flex-md-row"
                                >
                                    <div
                                        class="w-100 mb-3 mb-lg-0"
                                        v-if="form.search_type == 'zip_code'"
                                    >
                                        <input
                                            type="text"
                                            v-model="form.zip_code"
                                            class="form-control p-0"
                                            id="findlawyerListing"
                                            :placeholder="__('search zip code')"
                                        />
                                    </div>
                                    <div
                                        class="w-100 mb-3 mb-lg-0"
                                        v-if="form.search_type == 'distance'"
                                    >
                                        <Multiselect
                                            v-model="form.distance"
                                            :close-on-select="true"
                                            :searchable="true"
                                            :options="distanceOptions"
                                            valueProp="value"
                                            label="name"
                                            :placeholder="__('select distance')"
                                            class="form-control"
                                        />
                                    </div>
                                    <div
                                        class="w-100 mb-3 mb-lg-0"
                                        v-if="form.search_type == 'location'"
                                    >
                                        <div
                                            class="input-group-from position-relative"
                                        >
                                            <vue-google-autocomplete
                                                id="map"
                                                ref="address"
                                                enable-geolocation
                                                classname="form-control p-0 py-3"
                                                :placeholder="
                                                    __('search location')
                                                "
                                                v-on:inputChange="
                                                    updateLocation
                                                "
                                                v-on:placechanged="
                                                    getAddressData
                                                "
                                            >
                                            </vue-google-autocomplete>
                                            <button
                                                class="btn btn-primary position-absolute"
                                                style="right: 10px; top: 8px"
                                                @click="getCurrentLocation()"
                                            >
                                                <i
                                                    class="bi bi-geo-alt-fill"
                                                ></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="w-100 mb-3 mb-lg-0"
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
                                </div>
                            </div>
                            <div>
                                <hr />
                            </div>


                            <div class="px-3">
                                <div class="d-grid">
                                    <button
                                        :href="route('lawyers.listing')"
                                        @click="submit"
                                        class="btn btn-primary mb-3"
                                        type="submit"
                                        :disabled="isLoading"
                                    >

                                                  <SpinnerLoader v-if="isLoading" />
                    {{ __('Search') }}
                                    </button>
                                    <button
                                        @click="clearFilters"
                                        class="btn btn-secondary"
                                        :disabled="isClearLoading"
                                    >
                                    <SpinnerLoader v-if="isClearLoading" />
                                    {{ __('Clear') }}
                                    </button>
                                </div>
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
import axios from "axios";
import { router } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default defineComponent({
    components: {
        ValidationErrors,
        Link,
        SpinnerLoader,
        Multiselect,
        VueGoogleAutocomplete,
    },
    props: {
        is_redirect: {
            type: Boolean,
            default: true,
        },
        home: {
            type: Boolean,
            default: false,
        },
        is_lawyer_page: {
            type: Boolean,
            default: false,
        },
    },
    created() {
        if (this.is_lawyer_page) {
            this.getLawyerMainCategories();
            this.getCountries();
        }

        if (this.$page.props.main_category_slug) {
            this.lawyer_category_selected = this.$page.props.main_category_slug
        }
        if (this.$page.props.lawyer_category) {
            this.form.lawyer_category.push(this.$page.props.lawyer_category)
        }
        this.$emit("getLawyers", this.form);
        this.formDistanceOptions();
    },
    data() {
        return {
            form: {
                lawyer_category: this.$page.props.category ? (this.$page.props.category ? [this.$page.props.category] : []) : [],
                search: this.$page.props.data ? this.$page.props.data.search : "",
                country: route().params.country ?? "",
                location:
                    route().params.search_type == "location" &&
                    route().params.location
                        ? route().params.location
                        : "",
                latitude: route().params.latitude ?? "",
                longitude: route().params.longitude ?? "",
                search_type: route().params.search_type ?? "country",
                distance:
                    route().params.search_type == "distance" &&
                    route().params.distance
                        ? route().params.distance
                        : "",
                zip_code:
                    route().params.search_type == "zip_code" &&
                    route().params.zip_code
                        ? route().params.zip_code
                        : "",
                main_category: this.$page.props.main_category ? this.$page.props.main_category.slug : "all",

            },
            isLoading:false,
            isClearLoading:false,
            countries: [],
            lawyer_categories: [],
            lawyer_main_categories: [],
            distanceOptions: [],
            lawyer_category_selected: this.$page.props.lawyer_category ?? "",
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
        this.$emit("getlawyers", this.form);
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
                let innerObj = {
                    id: 'all',
                    name: "All",
                    slug: "all",
                    is_featured: 1,
                    is_active: 1,
                    image: null,
                    icon: null,
                    description: null,
                    created_at: null,
                    updated_at: null
                    };
                    let myObject = {
                    id: 'all',
                    name: this.__('select all'),
                    categories: [innerObj],
                    slug: "all",
                    is_featured: 1,
                    is_active: 1,
                    image: null,
                    icon: null,
                    description: null,
                    created_at: null,
                    updated_at: null
                    };
                    this.lawyer_main_categories.unshift(myObject);
                        if(this.form.lawyer_category[0] == "all"){
                        this.checkIsAllSelected("all")
                    }
            });
        },
        getCountries() {
            axios.get(this.route("getApiCountries")).then((res) => {
                this.countries = res.data.data;
            });
        },
        submit() {
            this.isLoading = true;
            const fetchDataPromise = new Promise((resolve, reject) => {
                setTimeout(() => {
                    var payload = {
                      data: this.form,
                    replace: true,
                    preserveScroll: true,
                }
                const data = this.$inertia.post(this.route("lawyers.listing"),payload);
                this.$emit("getLawyers", this.form);
                resolve(data);
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
        checkIsAllSelected(slug) {
            if (slug == "all") {
                if (event && event.target && event.target.checked == false) {
                    this.form.lawyer_category = [];
                } else {
                    this.form.lawyer_category = [];
                    for (
                        let i = 0;
                        i < this.lawyer_main_categories.length;
                        i++
                    ) {
                        for (
                            let j = 0;
                            j <
                            this.lawyer_main_categories[i].categories.length;
                            j++
                        ) {
                            this.form.lawyer_category.push(
                                this.lawyer_main_categories[i].categories[j]
                                    .slug
                            );
                        }
                    }
                }
            } else {
                var index = this.form.lawyer_category.findIndex(
                    (obj) => obj === "all"
                );
                if (index >= 0) {
                    var removed = this.form.lawyer_category.splice(index, 1);
                    this.$page.props.selected_category =
                        this.form.lawyer_category;
                }
            }
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
        lawyerCategoryChange(val) {
              this.checkIsAllSelected(val);
            // console.log(val.target.value);
            // if(val.target.value == 'all'){
            //   for (let i = 0; i < this.cars.lawyer_categories.lenght; i++) {
            //     text += cars[i] + "<br>";
            //   }
            // }

            var selected_cat = this.lawyer_main_categories.find((cat) => {
                return cat.categories.find((sub_cat) => sub_cat.slug == val);
            });
            if (selected_cat) {
                this.form.main_category = selected_cat.slug;
            } else {
                this.form.main_category = "all";
            }
        },
        searchTypeChanged() {
            this.form.distance = "";
            this.form.location = "";
            this.form.country = "";
            this.form.zip_code = "";
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
        clearFilters() {
            this.isClearLoading = true;
            const fetchDataPromise = new Promise((resolve, reject) => {
                setTimeout(() => {
                    this.form.latitude = "";
                        this.form.longitude = "";
                        this.form.location = "";
                        this.form.distance = "";
                        this.form.location = "";
                        this.form.country = "";
                        this.form.zip_code = "";
                        this.form.lawyer_category = "";
                        this.form.search = "";
                        this.form.search_type = "";

                        this.$inertia.replace(this.route("lawyers.listing"));
                        this.$emit("getLawyers", this.form);
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
    },
});
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
