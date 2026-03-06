<template>
    <guest-layout>
      <Head title="Log in" />
      <div class="section login py-5">
        <div class="container">

          <div class="row align-items-center">
            <div class="col-md-6">
              <div>
                <Link :href="route('home')">
                    <img width="200" :src="$page.props.settings.logo" alt="logo" />
                  </Link>
                  <div v-if="getPageContentType('login_page_description') == 'textarea'">
                                    <div v-html="getPageContent('login_page_description')"> </div>
                            </div>
                                <div v-else-if="getPageContentType('login_page_description') == 'text'">
                                        <p> {{getPageContent('login_page_description') ?? '-'}} </p>
                                </div>
                  <div v-else>
                    <p class="fs-3 mb-0 text-white mt-3">
                      Welcome to |
                      <span class="text-primary">Law Consulting</span>
                    </p>

                    <p
                      class="mb-0 text-muted"
                    >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi sequi ex velit. Hic ut numquam blanditiis est sunt ullam tenetur aspernatur facilis inventore, quaerat id eaque ipsum voluptas adipisci esse!</p>
                  </div>
                <div class="text-white py-5">
                  <div v-if="getPageContentType('login_page_login_text') == 'textarea'">
                    <div v-html="getPageContent('login_page_login_text')"></div>
                  </div>
                  <h1 v-else class="fw-bold display-1 mb-4 text-capitalize">{{ getPageContent('login_page_login_text') ?? __('login as') }}</h1>
                  <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button
                        class="nav-link text-capitalize"
                        :class="{active: tab == 'user'}"
                        @click="changeTab('user',0)"
                        id="customer-login-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#customer-login-pane"
                        type="button"
                        role="tab"
                        aria-controls="customer-login-pane"
                        aria-selected="true"
                      >{{ __('user') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button
                        class="nav-link text-capitalize"
                        :class="{active: tab == 'lawyer'}"
                        @click="changeTab('lawyer',1)"
                        id="lawyer-login-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#lawyer-login-pane"
                        type="button"
                        role="tab"
                        aria-controls="lawyer-login-pane"
                        aria-selected="false"
                      >{{ __('lawyer') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button
                        class="nav-link text-capitalize"
                        :class="{active: tab == 'law_firm'}"
                        @click="changeTab('law_firm',2)"
                        id="law_firm-login-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#law_firm-login-pane"
                        type="button"
                        role="tab"
                        aria-controls="law_firm-login-pane"
                        aria-selected="false"
                      >{{ __('law_firm') }}</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <customer-login :active="tab == 'user'" :redirectUrl="redirect_url"></customer-login>
                    <lawyer-login :active="tab == 'lawyer'"></lawyer-login>
                    <law-firm-login :active="tab == 'law_firm'"></law-firm-login>
                  </div>
                </div>
              </div>

              <div class="card-body form-section pe-md-5"></div>
            </div>

            <div class="col-md-6">
              <Carousel ref="carousel" v-model="currentSlide" :settings="settings" :breakpoints="breakpoints">
                  <Slide v-for="slide in 4" :key="slide">
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
              </authentication-card> -->
            </div>
          </div>
        </div>
      </div>

      <!-- Button trigger modal -->
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
      </button>-->

      <!-- Modal -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-xl">
          <div class="modal-content" style="background-color: #ccc;">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Select Pricing Plan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="col-12">
                <div class="row justify-content-center pb-3">
                  <div class="col-md-4 px-4 mt-3">
                    <div class="card bg-transparent border-0">
                      <div
                        class="card-body py-5 rounded-top-pill bg-white"
                        style="border-radius: 200px 200px 30px 30px;"
                      >
                        <h5 class="text-center mb-0" style="color: #744FB9;">Subscription</h5>
                        <h4 class="card-title text-center">
                          <span class="fw-bold fs-1">Basic</span>(free)
                        </h4>
                        <p class="card-text text-center">Choose Customer Services for free</p>
                        <div
                          class="tag text-center py-2 mx-5 mb-4 text-white fs-3 rounded-pill"
                          style="background-color: #3F3F3F;"
                        >$0.00/month</div>
                        <ul class="ps-0 mb-0">
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i
                              class="bi fs-2 bi-check position-absolute"
                              style="right:10px; top:8px;"
                            ></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                        </ul>
                      </div>
                      <div
                        class="card-footer p-4 border-0 bg-white"
                        style="border-radius: 0 0 30px 30px; margin: 0 100px;"
                      >
                        <button class="btn btn-primary">Get This Plan</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 px-4 mt-3">
                    <div class="card bg-transparent border-0">
                      <div
                        class="card-body py-5 rounded-top-pill bg-white"
                        style="border-radius: 200px 200px 30px 30px;"
                      >
                        <h5 class="text-center mb-0" style="color: #744FB9;">Subscription</h5>
                        <h4 class="card-title text-center">
                          <span class="fw-bold fs-1">Basic</span>(free)
                        </h4>
                        <p class="card-text text-center">Choose Customer Services for free</p>
                        <div
                          class="tag text-center py-2 mx-5 mb-4 text-white fs-3 rounded-pill"
                          style="background-color: #3F3F3F;"
                        >$0.00/month</div>
                        <ul class="ps-0 mb-0">
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i
                              class="bi fs-2 bi-check position-absolute"
                              style="right:10px; top:8px;"
                            ></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                        </ul>
                      </div>
                      <div
                        class="card-footer p-4 border-0 bg-white"
                        style="border-radius: 0 0 30px 30px; margin: 0 100px;"
                      >
                        <button class="btn btn-primary">Get This Plan</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 px-4 mt-3">
                    <div class="card bg-transparent border-0">
                      <div
                        class="card-body py-5 rounded-top-pill bg-white"
                        style="border-radius: 200px 200px 30px 30px;"
                      >
                        <h5 class="text-center mb-0" style="color: #744FB9;">Subscription</h5>
                        <h4 class="card-title text-center">
                          <span class="fw-bold fs-1">Basic</span>(free)
                        </h4>
                        <p class="card-text text-center">Choose Customer Services for free</p>
                        <div
                          class="tag text-center py-2 mx-5 mb-4 text-white fs-3 rounded-pill"
                          style="background-color: #3F3F3F;"
                        >$0.00/month</div>
                        <ul class="ps-0 mb-0">
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i
                              class="bi fs-2 bi-check position-absolute"
                              style="right:10px; top:8px;"
                            ></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                        </ul>
                      </div>
                      <div
                        class="card-footer p-4 border-0 bg-white"
                        style="border-radius: 0 0 30px 30px; margin: 0 100px;"
                      >
                        <button class="btn btn-primary">Get This Plan</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 px-4 mt-3">
                    <div class="card bg-transparent border-0">
                      <div
                        class="card-body py-5 rounded-top-pill bg-white"
                        style="border-radius: 200px 200px 30px 30px;"
                      >
                        <h5 class="text-center mb-0" style="color: #744FB9;">Subscription</h5>
                        <h4 class="card-title text-center">
                          <span class="fw-bold fs-1">Basic</span>(free)
                        </h4>
                        <p class="card-text text-center">Choose Customer Services for free</p>
                        <div
                          class="tag text-center py-2 mx-5 mb-4 text-white fs-3 rounded-pill"
                          style="background-color: #3F3F3F;"
                        >$0.00/month</div>
                        <ul class="ps-0 mb-0">
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i
                              class="bi fs-2 bi-check position-absolute"
                              style="right:10px; top:8px;"
                            ></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                        </ul>
                      </div>
                      <div
                        class="card-footer p-4 border-0 bg-white"
                        style="border-radius: 0 0 30px 30px; margin: 0 100px;"
                      >
                        <button class="btn btn-primary">Get This Plan</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 px-4 mt-3">
                    <div class="card bg-transparent border-0">
                      <div
                        class="card-body py-5 rounded-top-pill bg-white"
                        style="border-radius: 200px 200px 30px 30px;"
                      >
                        <h5 class="text-center mb-0" style="color: #744FB9;">Subscription</h5>
                        <h4 class="card-title text-center">
                          <span class="fw-bold fs-1">Basic</span>(free)
                        </h4>
                        <p class="card-text text-center">Choose Customer Services for free</p>
                        <div
                          class="tag text-center py-2 mx-5 mb-4 text-white fs-3 rounded-pill"
                          style="background-color: #3F3F3F;"
                        >$0.00/month</div>
                        <ul class="ps-0 mb-0">
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i
                              class="bi fs-2 bi-check position-absolute"
                              style="right:10px; top:8px;"
                            ></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                          <li
                            class="bg-light p-3 mb-3 d-flex justify-content-between position-relative"
                          >
                            <div class="d-flex">
                              <i class="bi bi-circle-fill"></i>
                              <span class="ms-3">Profile Listing</span>
                            </div>

                            <i class="bi fs-2 bi-x position-absolute" style="right:10px; top:8px;"></i>
                          </li>
                        </ul>
                      </div>
                      <div
                        class="card-footer p-4 border-0 bg-white"
                        style="border-radius: 0 0 30px 30px; margin: 0 100px;"
                      >
                        <button class="btn btn-primary">Get This Plan</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
  import CustomerLogin from "@/Components/Customers/CustomerLogin.vue";
  import LawyerLogin from "@/Components/Lawyers/LawyerLogin.vue";
  import LawFirmLogin from "@/Components/LawFirms/LawFirmLogin.vue";
  import GuestLayout from "@/Layouts/GuestLayout.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";
  import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
  import { ref } from 'vue'
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
      CustomerLogin,
      LawyerLogin,
      LawFirmLogin,
      GuestLayout,
      Link,
      Carousel,
      Slide,
      Pagination,
      Navigation
    },

    props: {
      canResetPassword: Boolean,
      status: String,
      redirect_url : String,

    },

    data() {
      return {
        currentSlide: 0,
        tab: route().params.tab ?? "user",
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
      changeTab(tab,val) {
        this.tab = tab;
        this.$inertia.replace(route("login"), {
          data: { tab: this.tab },
          preserveScroll: true
        });
        this.slideTo(val);
      },
      slideTo(val) {
      this.currentSlide = val;
    },}

  });
  </script>
