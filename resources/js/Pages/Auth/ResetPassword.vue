<template>
  <auth-layout>
    <Head title="Reset Password" />

    <div class="section login py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div>
              <div v-if="getPageContentType('reset_password_page') == 'textarea'">
                                    <div v-html="getPageContent('reset_password_page')"> </div>
                            </div>
                                <div v-else-if="getPageContentType('reset_password_page') == 'text'">
                                        <p> {{getPageContent('reset_password_page') ?? '-'}} </p>
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
                <h1 class="fw-bold display-1 mb-4 text-capitalize">Reset Password ?</h1>
                <p>Please enter new password.</p>
                <div v-if="status" class="alert alert-success" role="alert">{{ status }}</div>

                <form @submit.prevent="submit">
                  <validation-errors class="mb-2" />
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group mb-4">
                          <div class="form-floating">
                            <input
                              id="password"
                              type="password"
                              placeholder="Password"
                              class="form-control py-3 border border-primary"
                              v-model="form.password"
                              required
                              autofocus
                            />
                       
                          </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-floating">
                                <input
                                id="password"
                                type="password"
                                placeholder="Confirm Password"
                                class="form-control py-3 border border-primary"
                                v-model="form.password_confirmation"
                                required
                              />

                           
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row align-items-center">
                      <div class="col-md-5">

                            <button
                              :class=" { 'text-white-50': form.processing }"
                              class=" submit btn btn-primary"
                              :disabled="form.processing"
                            >
                              <div
                                v-show="form.processing"
                                class="spinner-border spinner-border-sm"
                                role="status"
                              >
                                <div
                                  v-show="form.processing"
                                  class="spinner-border spinner-border-sm"
                                  role="status"
                                >
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                              </div>Reset
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
          </div>
        </div>
      </div>
    </div>
  </auth-layout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
export default defineComponent({
  components: {
    Head,
    AuthenticationCard,
    AuthenticationCardLogo,
    Button,
    Input,
    Label,
    AppLayout,
    ValidationErrors,
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
        password: "",
        password_confirmation: ""
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
      this.form
        .transform(data => ({
          ...data,
          token: this.route().params.token
        }))
        .post(this.route("password.reset"));
    }
  },
  mounted() {}
});
</script>
