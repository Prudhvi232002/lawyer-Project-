<template>
  <auth-layout>
    <Head title="Forgot Password" />

    <div class="section login py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div>
              <div v-if="getPageContentType('forgot_password_page') == 'textarea'">
                                    <div v-html="getPageContent('forgot_password_page')"> </div>
                            </div>
                                <div v-else-if="getPageContentType('forgot_password_page') == 'text'">
                                        <p> {{getPageContent('forgot_password_page') ?? '-'}} </p>
                                </div>
              <div v-else>
                <p class="fs-3 mb-0 text-white">
                Welcome to |
                <span class="text-primary">Law Consulting</span>
              </p>

              <p
                class="mb-0 text-muted"
              >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi sequi ex velit. Hic ut numquam blanditiis est sunt ullam tenetur aspernatur facilis inventore, quaerat id eaque ipsum voluptas adipisci esse!</p>
              </div>
 
              <div class="text-white py-5">
                <h1 class="fw-bold display-1 mb-4 text-capitalize">{{ __('forgot password') }}?</h1>
                <div v-if="status" class="alert alert-success" role="alert">{{ status }}</div>

                <form @submit.prevent="submit">
                  <validation-errors class="mb-2" />
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group mb-4">
                            <div class="form-floating">

                          <input
                            id="email"
                            type="email"
                            placeholder="Email Address"
                            class="form-control py-3 border border-primary"
                            v-model="form.email"
                            required
                            autofocus
                          />
                       
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row align-items-center">
                      <div class="col-md-5">
                        <button
                          :class="{ 'text-white-50': form.processing }"
                          class="submit btn btn-primary "
                          :disabled="form.processing"
                        >
                          <SpinnerLoader v-if="form.processing" />
                          {{ __('reset password') }}
                        </button>
                      </div>
                      <div class="col-md-7 text-end">
                        <Link :href="route('login')">{{ __('return to login') }}</Link>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="card-body form-section pe-md-5"></div>
          </div>

          <div class="col-md-6">
            <Carousel
              ref="carousel"
              v-model="currentSlide"
              :settings="settings"
              :breakpoints="breakpoints"
            >
              <Slide v-for="slide in 4" :key="slide">
                <div class="carousel__item">
               
                  <img style="position: relative;" src="@/images/home/slider-img.png" alt class="img-fluid" />
                  <div class="background-custom"></div>
               
                </div>
              </Slide>

              <template #addons>
                <Pagination />
              </template>
            </Carousel>

            <!-- <authentication-card>
                <template #logo>
                  <authentication-card-logo />
                </template>

                <p class="py-4 text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a vestibulum metus, sed ultrices tellus.
                  Etiam finibus elit non condimentum auctor. Fusce porttitor rhoncus dolor et iaculis. Ut ac orci nec mi
                  faucibus pulvinar. Vivamus neque risus, lacinia eget cursus sed, vehicula ut turpis. Nulla luctus et
                  sapien non viverra. Maecenas ut pretium erat. Vestibulum ante ipsum primis in faucibus orci luctus et
                  ultrices posuere cubilia curae; Vestibulum faucibus interdum mi a fringilla.
                </p>
            </authentication-card>-->
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="section login py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <authentication-card>

              <p class="py-4 fs-5">
                {{ __('login_text') }}
              </p>
            </authentication-card>


          </div>
          <div class="col-md-6">
            <div class="card border-0" style="border-radius: 30px 150px 30px 30px; background-color: #f4f4f4;">
              <div class="card-body p-5">


                <div class="mb-4">

                  <h1 class="fw-bold display-1 mb-4 text-capitalize">{{ __('forgot password') }}?</h1>

                </div>

                <div v-if="status" class="alert alert-success" role="alert">
                  {{ status }}
                </div>


                <form @submit.prevent="submit">
                  <validation-errors class="mb-2" />
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group mb-3">
                          <label for="password">{{__('email address')}}</label>
                          <input id="email" type="email" placeholder="Email Address" class="w-100 form-control border border-primary px-3"
                            v-model="form.email" required autofocus />
                        </div>

                      </div>

                    </div>

                    <div class="row align-items-center">
                      <div class="col-md-5">
                        <button :class="{ 'text-white-50': form.processing }"
                          class="submit btn btn-primary border-0 rounded w-100 text-white text-capitalize"
                          :disabled="form.processing">
                          <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                              <span class="visually-hidden">{{__('loading')}}...</span>
                            </div>
                          </div>

                          {{ __('reset password') }}
                        </button>
                      </div>
                      <div class="col-md-7">
                        <Link :href="route('login')">{{ __('return to login') }}</Link>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
  </auth-layout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
export default defineComponent({
  components: {
    Head,
    AuthenticationCard,
    AuthenticationCardLogo,
    Button,
    Input,
    Label,
    ValidationErrors,
    GuestLayout,
    AppLayout,
    SpinnerLoader,
    Link,
    Carousel,
    Slide,
    Pagination,
      Navigation
  },

  props: {
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: ""
      }),
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
        autoplay: false,
        wrapAround: "true"
      },
      // breakpoints are mobile first
      // any settings not specified will fallback to the carousel settings
      breakpoints: {
        // 1024 and up
        1024: {
          itemsToShow: 1,
          snapAlign: "center"
        }
      }
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.forgot"));
    }
  }
});
</script>
