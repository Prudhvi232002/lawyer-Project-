<template>
  <div class="tab-pane " :class="{ active: active }" id="general-info" role="tabpanel" aria-labelledby="genetal-info-tab"
    tabindex="0">
    <form @submit.prevent="submit" class="profileForm">
      <div class="row">
        <div class="col-12 position-relative">
            <label for="lawyer-cover-image" style="position: absolute; right: 20px; top: 10px; ">
                <div class="icon z-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                    style="cursor: pointer; width: 40px; height: 40px;">
                    <i class="bi bi-pencil-fill"></i>
                </div>

                <ImageCropperModal :show="showCoverImportModal" id="coverImageCropModal"
                    :image_url="cover_image_url" @cropImage="cropCoverImage" aspectRatio="2/1">
                </ImageCropperModal>
            </label>
            <div class="cover-header rounded-2" v-if="!form.cover_image && !$page.props.customer.cover_image">
            </div>
            <div v-if="form.cover_image" class="cover-header rounded-2"
                v-bind:style="{ 'background-image': 'url(' + form.cover_image + ')' }"></div>
            <div class="cover-header rounded-2" v-if="!form.cover_image && $page.props.customer.cover_image"
                v-bind:style="{ 'background-image': 'url(' + $page.props.customer.cover_image + ')' }"></div>
        </div>
            <div class="col-md-3">
                <div >
                    <label for="lawyer-image">
                        <!-- <label for="image" class="mb-3">{{ __('select') }} {{ __('image') }}</label> -->
                        <div class="profile-image mx-4 mb-5 shadow rounded-2 position-relative" style="background-color:#E4E4E4; width:220px">
                            <div class="icon position-absolute z-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="cursor:pointer;width: 40px; height: 40px;">
                                <i class="bi bi-pencil-fill "></i>
                            </div>
                            <img v-if="form.image" class="img-fluid" :src="form.image" alt="logo">
                            <img v-if="!form.image && $page.props.customer.image" class="img-fluid"
                                :src="$page.props.customer.image" alt="logo">
                            <img v-if="!form.image && !$page.props.customer.image" class="img-fluid"
                                src="@/images/account/default_avatar_men.png" alt="logo">
                        </div>
                        <button data-bs-toggle="modal" id="ImageCropperModalButton" data-bs-target="#imageCropModal"
                            style="display:none"></button>
                        <ImageCropperModal :show="showImportModal" id="imageCropModal" :image_url="image_url" @cropImage="cropImage">
                        </ImageCropperModal>
                    </label>
                    <input id="lawyer-image" style="display:none" @change="onFileChange" type="file" />
                    <input id="lawyer-cover-image" style="display: none" @change="onFileChangeCover" type="file" />
                </div>
            </div>

        <div class="col-md-12">
          <validation-errors></validation-errors>
          <!-- <validation-errors class="mb-3" /> -->

          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="user_name">{{ __('username') }}</label>
                    <input v-model="form.user_name"
                        class="w-100 form-control px-3"
                        placeholder="Please Enter" type="text" />
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="first_name">{{ __('first name') }}</label>
                    <input v-model="form.first_name"
                        class="w-100 form-control px-3"
                        placeholder="Please Enter" type="text" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="last_name">{{ __('last name') }}</label>
                    <input v-model="form.last_name"
                        class="w-100 form-control px-3"
                        placeholder="Please Enter" type="text" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="country">{{ __('select') }} {{ __('country') }}</label>
                    <select v-model="form.country_id" @change="getStates()" class="form-select"
                        aria-label="country">
                        <option value="null" selected disabled>{{ __('country') }}</option>
                        <option v-for="country in this.countries" :key="country.id" :value="country.id">
                            {{ country.name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="address">{{ __('address line') }} 1</label>
                    <textarea v-model="form.address_line_1"
                        class="w-100 form-control px-3"
                        placeholder="Please Enter" type="text"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="address">{{ __('address line') }} 2</label>
                    <textarea v-model="form.address_line_2"
                        class="w-100 form-control px-3"
                        placeholder="Please Enter" type="text"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="state">{{ __('select') }} {{ __('state') }}</label>
                    <select v-model="form.state_id" @change="getCities()" class="form-select"
                        aria-label="state">
                        <option value="null" selected disabled>{{ __('state') }}</option>
                        <option v-for="state in this.states" :key="state.id" :value="state.id">{{
                            state.name
                        }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="city">{{ __('select') }} {{ __('city') }}</label>
                    <select v-model="form.city_id" class="form-select" aria-label="city">
                        <option value="null" selected disabled>{{ __('city') }}</option>
                        <option v-for="city in this.cities" :key="city.id" :value="city.id">{{
                            city.name
                        }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="zip_code">{{ __('zip code') }}</label>
                    <input v-model="form.zip_code"
                        class="w-100 form-control px-3"
                        placeholder="Please Enter" type="text" />
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="description">{{ __('description') }}</label>
                    <textarea v-model="form.description"
                        class="w-100 form-control px-3"
                        placeholder="Please Enter" type="text" rows="6"></textarea>
                </div>
            </div>
            </div>

            <div class="row align-items-center">
              <div class="col-md-2">
                <button type="submit" :disabled="form.processing" class="submit btn btn-primary">
                  <SpinnerLoader v-if="form.processing" />
                    {{ __('save') }}
                </button>
              </div>
            </div>
          </div>

        </div>

      </div>
    </form>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import ImageCropperModal from "@/Components//Shared/ImageCropperModal.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default defineComponent({
  components: {
    Head,
    ValidationErrors,
    SpinnerLoader,
    ImageCropperModal,
    Link,
  },
  props: ['active'],
  data() {
    return {
      form: this.$inertia.form({
        country_id: this.$page.props.customer.country_id,
        state_id: this.$page.props.customer.state_id,
        city_id: this.$page.props.customer.city_id,
        first_name: this.$page.props.customer.first_name,
        last_name: this.$page.props.customer.last_name,
        user_name: this.$page.props.customer.user_name,
        description: this.$page.props.customer.description,
        address_line_1: this.$page.props.customer.address_line_1,
        address_line_2: this.$page.props.customer.address_line_2,
        zip_code: this.$page.props.customer.zip_code,
        icon: null,
        image: null,
        cover_image: null,
        username: this.$page.props.customer.username
      }),
      showImportModal:false,
      image_url: null,
      cover_image: null,
      cover_image_url: null,
      croppedImageSrc:null,
      showCoverImportModal: false,
      croppedCoverImageSrc: null,
      countries: this.$page.props.countries,
      states: this.$page.props.states,
      cities: this.$page.props.cities,
    };
  },


  methods: {
    onFileChange(e) {
            this.image_url = null
            const file = e.target.files[0];
            this.image_url = URL.createObjectURL(file);
            this.croppedImageSrc = null
            this.showImportModal = true
        },
        onFileChangeCover(e) {
            this.cover_image_url = null;
            const file = e.target.files[0];
            this.cover_image_url = URL.createObjectURL(file);
            this.croppedCoverImageSrc = null;
            this.showCoverImportModal = true;
        },
        cropImage(image) {
            this.croppedImageSrc = image
            this.form.image = image
            this.image_url = null
            this.showImportModal = false
        },
        cropImage(image) {
            this.croppedImageSrc = image;
            this.form.image = image;
            this.image_url = null;
            this.showImportModal = false;
        },
        cropCoverImage(image) {
            this.croppedCoverImageSrc = image;
            this.form.cover_image = image;
            this.cover_image_url = null;
            this.showCoverImportModal = false;
        },
    getStates() {
      this.form.state_id = null
      this.form.city_id = null
      axios.get(this.route('account.getStates', {
        'country_id': this.form.country_id,
      })).then(res => {
        this.states = res.data.data
      });
    },
    getCities() {
      this.form.city_id = null
      axios.get(this.route('account.getCities', {
        'country_id': this.form.country_id,
        'state_id': this.form.state_id,
      })).then(res => {
        this.cities = res.data.data
      });
    },
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("customers.update_general_info"), {
            onSuccess: () => {
                         this.goToNextTab()
                    }
        });
    },
    goToNextTab(){
            this.$inertia.visit(route('account'),{data:{active_tab:'bookings'}})
        }
  },
});
</script>
