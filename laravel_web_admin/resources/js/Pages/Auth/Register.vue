<template>
    <guest-layout>
      <Head title="Register" />
      <div class="section login py-5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div>
                <Link :href="route('home')">
                    <img width="200" :src="$page.props.settings.logo" alt="logo" />
                  </Link>
                  <div v-if="getPageContentType('register_page_description') == 'textarea'">
                                    <div v-html="getPageContent('register_page_description')"> </div>
                            </div>
                                <div v-else-if="getPageContentType('register_page_description') == 'text'">
                                        <p> {{getPageContent('register_page_description') ?? '-'}} </p>
                                </div>
                  <div v-else>
                    <p class="fs-3 mb-0 text-white mt-3">
                  Welcome to |
                  <span class="text-primary fw-bold">Law Consulting</span>
                </p>

                <p
                  class="mb-0 text-muted"
                >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi sequi ex velit. Hic ut numquam blanditiis est sunt ullam tenetur aspernatur facilis inventore, quaerat id eaque ipsum voluptas adipisci esse!</p>

              </div>


                <div class="text-white">
                  <div v-if="getPageContentType('register_page_signup_text') == 'textarea'">
                    <div v-html="getPageContent('register_page_signup_text')"></div>
                  </div>
                  <h1 v-else class="fw-normal display-2 my-4 text-capitalize">{{ __('signup as') }}</h1>
                  <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button
                        class="nav-link"
                        id="customer-register-tab"
                        :class="{active: tab == 'user'}"
                        @click="changeTab('user', 0)"
                        data-bs-toggle="tab"
                        data-bs-target="#customer-register-pane"
                        type="button"
                        role="tab"
                        aria-controls="customer-register-pane"
                        aria-selected="true"
                      >{{ __('user') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button
                        class="nav-link"
                        id="lawyer-register-tab"
                        :class="{active: tab == 'lawyer'}"
                        @click="changeTab('lawyer', 1)"
                        data-bs-toggle="tab"
                        data-bs-target="#lawyer-register-pane"
                        type="button"
                        role="tab"
                        aria-controls="lawyer-register-pane"
                        aria-selected="false"
                      >{{ __('lawyer') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button
                        class="nav-link"
                        id="law_firm-register-tab"
                        :class="{active: tab == 'law_firm'}"
                        @click="changeTab('law_firm', 2)"
                        data-bs-toggle="tab"
                        data-bs-target="#law_firm-register-pane"
                        type="button"
                        role="tab"
                        aria-controls="law_firm-register-pane"
                        aria-selected="false"
                      >{{ __('law_firm') }}</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <customer-register :active="tab == 'user'"></customer-register>
                    <lawyer-register :active="tab == 'lawyer'"></lawyer-register>
                    <law-firm-register :active="tab == 'law_firm'"></law-firm-register>
                  </div>
                </div>
              </div>

              <div class="card-body form-section pe-md-5">
                <!-- <div
              v-if="status"
              class="alert alert-success mb-3 rounded-0"
              role="alert"
          >
              {{ status }}
                </div>-->
              </div>
            </div>

            <div class="col-md-6">
              <Carousel v-model="currentSlide" :settings="settings" :breakpoints="breakpoints">
                <Slide v-for="slide in 3" :key="slide">
                  <div class="carousel__item">
                      <img
                      style="position: relative;"
                      src="@/images/home/slider-img.png"
                      alt
                      class="img-fluid"
                    />
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
    </guest-layout>
  </template>

  <script>
  import { defineComponent } from "vue";
  import AuthenticationCard from "@/Components/AuthenticationCard.vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
  import Button from "@/Components/Button.vue";
  import Input from "@/Components/Input.vue";
  import Checkbox from "@/Components/Checkbox.vue";
  import Label from "@/Components/Label.vue";
  import ValidationErrors from "@/Components/ValidationErrors.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";
  import LawyerRegister from "@/Components/Lawyers/LawyerRegister.vue";
  import CustomerRegister from "@/Components/Customers/CustomerRegister.vue";
  import LawFirmRegister from "@/Components/LawFirms/LawFirmRegister.vue";
  import GuestLayout from "@/Layouts/GuestLayout.vue";
  import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";

  export default defineComponent({
    components: {
      Head,
      AuthenticationCard,
      AuthenticationCardLogo,
      Button,
      Input,
      Checkbox,
      Label,
      AppLayout,
      ValidationErrors,
      LawyerRegister,
      CustomerRegister,
      LawFirmRegister,
      Link,
      GuestLayout,
      Link,
      Carousel,
      Slide,
      Pagination,
      Navigation
    },

    props: {
      canResetPassword: Boolean,
      status: String
    },
    data() {
      return {
        currentSlide:0,
        tab: route().params.tab ?? "user",
        // carousel settings
        settings: {
          itemsToShow: 1,
          snapAlign: "center",
          autoplay:false,
          wrapAround:'true'
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
      changeTab(tab, val) {
        this.tab = tab;
        this.$inertia.replace(route("register"), {
          data: { tab: this.tab },
          preserveScroll: true
        });
        this.slideTo(val);
      },
      slideTo(val) {
      this.currentSlide = val;
    }
    }
  });
  </script>
