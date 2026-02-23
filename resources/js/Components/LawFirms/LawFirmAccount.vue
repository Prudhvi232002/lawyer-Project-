<template>
  <div class="container-fluid py-5 border-bottom border-dark">
    <div class="row">
      <div class="col-12">
        <h2 class="fs-2 text-center">
          <span class="fw-normal"
            >Hello {{ $page.props.auth.user.name }} |</span
          >
          <span class="fw-bold"> Set Profile</span>
        </h2>
        <!-- <p class="text-center mb-0">Discover The Best Lawyers Near You</p> -->
      </div>
      <breadcrums :breadcrums="breadcrums"></breadcrums>
    </div>
  </div>
  <div class="section p-0 profile">
    <div class="container">
      <div class="row g-0">
        <div class="col-md-3 p-4">
          <div
            class="nav flex-column nav-pills account-tabs"
            id="v-pills-tab"
            role="tablist"
            aria-orientation="vertical"
          >
            <li class="nav-item mb-3" role="presentation" >
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'general-info' }"
                @click="changeTab('general-info')"
                id="general-info-tab"
                data-bs-toggle="tab"
                data-bs-target="#general-info"
                type="button"
                role="tab"
                aria-controls="general-info"
                aria-selected="true"
              >
                {{ __("general info") }}
              </button>
            </li>
            <!-- v-if="hasModule('test')" -->
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-social-info', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'social-info' }"
                @click="changeTab('social-info')"
                id="social-info-tab"
                data-bs-toggle="tab"
                data-bs-target="#socialInfo"
                type="button"
                role="tab"
                aria-controls="social-info"
                aria-selected="false"
              >
                {{ __("social info") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'certifications' }"
                @click="changeTab('certifications')"
                id="certifications-tab"
                data-bs-toggle="tab"
                data-bs-target="#certifications"
                type="button"
                role="tab"
                aria-controls="certifications"
                aria-selected="false"
              >
                {{ __("certifications") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation" >
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'lawyers' }"
                @click="changeTab('lawyers')"
                id="lawyers-tab"
                data-bs-toggle="tab"
                data-bs-target="#lawyers"
                type="button"
                role="tab"
                aria-controls="lawyers"
                aria-selected="false"
              >
                {{ __("lawyers") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation"
                v-if="!isSubscriptionEnabled() || hasModule('law_firm-services', 'law_firm')">
                <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'services' }"
                    @click="changeTab('services')" id="services-tab" data-bs-toggle="tab"
                    data-bs-target="#services" type="button" role="tab" aria-controls="services"
                    aria-selected="false">{{ __n('service') }}</button>
            </li>
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-broadcasts', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'broadcasts' }"
                @click="changeTab('broadcasts')"
                id="broadcasts-tab"
                data-bs-toggle="tab"
                data-bs-target="#broadcasts"
                type="button"
                role="tab"
                aria-controls="broadcasts"
                aria-selected="false"
              >
                {{ __n("broadcast") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-podcasts', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'podcasts' }"
                @click="changeTab('podcasts')"
                id="podcasts-tab"
                data-bs-toggle="tab"
                data-bs-target="#podcasts"
                type="button"
                role="tab"
                aria-controls="podcasts"
                aria-selected="false"
              >
                {{ __n("podcast") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-events', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'events' }"
                @click="changeTab('events')"
                id="events-tab"
                data-bs-toggle="tab"
                data-bs-target="#events"
                type="button"
                role="tab"
                aria-controls="events"
                aria-selected="false"
              >
                {{ __n("event") }}
              </button>
            </li>
            <!-- <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-events', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'products' }"
                @click="changeTab('products')"
                id="products-tab"
                data-bs-toggle="tab"
                data-bs-target="#products"
                type="button"
                role="tab"
                aria-controls="products"
                aria-selected="false"
              >
                {{ __n("product") }}
              </button>
            </li> -->
            <li class="nav-item mb-3" role="presentation" >
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'youtube' }"
                @click="changeTab('youtube')"
                id="youtube-tab"
                data-bs-toggle="tab"
                data-bs-target="#youtube"
                type="button"
                role="tab"
                aria-controls="youtube"
                aria-selected="false"
              >
                {{ __("youtube") }}
              </button>
            </li>
            <!-- <li class="nav-item mb-3" role="presentation">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'instagram' }"
                @click="changeTab('instagram')"
                id="instagram-tab"
                data-bs-toggle="tab"
                data-bs-target="#instagram"
                type="button"
                role="tab"
                aria-controls="instagram"
                aria-selected="false"
              >
                {{ __("instagram") }}
              </button>
            </li> -->
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-calendly', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'calendly' }"
                @click="changeTab('calendly')"
                id="calendly-tab"
                data-bs-toggle="tab"
                data-bs-target="#calendly"
                type="button"
                role="tab"
                aria-controls="calendly"
                aria-selected="false"
              >
                {{ __("calendly") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-appointment', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'appointment' }"
                @click="changeTab('appointment')"
                id="appointment-tab"
                data-bs-toggle="tab"
                data-bs-target="#appointment"
                type="button"
                role="tab"
                aria-controls="appointment"
                aria-selected="false"
              >
                {{ __("appointment") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-blogs', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'blogs' }"
                @click="changeTab('blogs')"
                id="blogs-tab"
                data-bs-toggle="tab"
                data-bs-target="#blogs"
                type="button"
                role="tab"
                aria-controls="blogs"
                aria-selected="false"
              >
                {{ __n("blog") }}
              </button>
            </li>
            <li class="nav-item mb-3" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('law_firm-archives', 'law_firm')">
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'archives' }"
                @click="changeTab('archives')"
                id="archives-tab"
                data-bs-toggle="tab"
                data-bs-target="#archives"
                type="button"
                role="tab"
                aria-controls="archives"
                aria-selected="false"
              >
                {{ __n("archive") }}
              </button>
            </li>
            <li class="nav-item">
              <a
                :href="route('law_firm.my_profile')"
                class="nav-link"
                target="_blank"
                ><i class="bi bi-box-arrow-up-right"></i> {{ __('preview profile') }}</a
              >
            </li>
          </div>
        </div>

        <div class="col-md-9 border-start border-dark">
          <!-- Tab panes -->
          <div class="tab-content w-100 p-4" id="v-pills-tabContent">
            <law-firm-general-info :active="active_tab == 'general-info'"
            ></law-firm-general-info>
            <law-firm-social-info
              v-if="!isSubscriptionEnabled() || hasModule('law_firm-social-info', 'law_firm') && active_tab == 'social-info'" :active="active_tab == 'social-info'"
            ></law-firm-social-info>
            <law-firm-certifications
              v-if="active_tab == 'certifications'" :active="active_tab == 'certifications'"
            ></law-firm-certifications>
            <law-firm-lawyers
               :active="active_tab == 'lawyers'"
            ></law-firm-lawyers>
            <law-firm-services v-if="!isSubscriptionEnabled() || hasModule('law_firm-services', 'law_firm') && active_tab == 'services'" :active="active_tab == 'services'"></law-firm-services>
            <law-firm-broadcasts
              v-if="!isSubscriptionEnabled() || hasModule('law_firm-broadcasts', 'law_firm') && active_tab == 'broadcasts'" :active="active_tab == 'broadcasts'"
            ></law-firm-broadcasts>
            <law-firm-podcasts
              v-if="!isSubscriptionEnabled() || hasModule('law_firm-podcasts', 'law_firm') && active_tab == 'podcasts'" :active="active_tab == 'podcasts'"
            ></law-firm-podcasts>
            <law-firm-events v-if="!isSubscriptionEnabled() || hasModule('law_firm-events', 'law_firm') && active_tab == 'events'" :active="active_tab == 'events'"></law-firm-events>
            <law-firm-products
              v-if="!isSubscriptionEnabled() || hasModule('law_firm-events', 'law_firm') && active_tab == 'products'" :active="active_tab == 'products'"
            ></law-firm-products>
            <law-firm-youtube :active="active_tab == 'youtube'"
            ></law-firm-youtube>
            <law-firm-instagram :active="active_tab == 'instagram'"
            ></law-firm-instagram>
            <law-firm-calendly
              v-if="!isSubscriptionEnabled() || hasModule('law_firm-calendly', 'law_firm') && active_tab == 'calendly'" :active="active_tab == 'calendly'"
            ></law-firm-calendly>
            <law-firm-appointment
              v-if="!isSubscriptionEnabled() || hasModule('law_firm-appointment', 'law_firm') && active_tab == 'appointment'" :active="active_tab == 'appointment'"
            ></law-firm-appointment>
            <law-firm-posts v-if="!isSubscriptionEnabled() || hasModule('law_firm-blogs', 'law_firm') && active_tab == 'blogs'" :active="active_tab == 'blogs'"></law-firm-posts>
            <law-firm-archives
              v-if="!isSubscriptionEnabled() || hasModule('law_firm-archives', 'law_firm') && active_tab == 'archives'" :active="active_tab == 'archives'"
            ></law-firm-archives>
          </div>
        </div>
      </div>
    </div>
  </div>
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
import LawFirmGeneralInfo from "@/Components/LawFirms/LawFirmGeneralInfo.vue";
import LawFirmSocialInfo from "@/Components/LawFirms/LawFirmSocialInfo.vue";
import LawFirmBroadcasts from "@/Components/LawFirms/Broadcasts/LawFirmBroadcasts.vue";
import LawFirmPodcasts from "@/Components/LawFirms/Podcasts/LawFirmPodcasts.vue";
import LawFirmEvents from "@/Components/LawFirms/Events/LawFirmEvents.vue";
import LawFirmPosts from "@/Components/LawFirms/Posts/LawFirmPosts.vue";
import LawFirmProducts from "@/Components/LawFirms/LawFirmProducts.vue";
import LawFirmYoutube from "@/Components/LawFirms/LawFirmYoutube.vue";
import LawFirmInstagram from "@/Components/LawFirms/LawFirmInstagram.vue";
import LawFirmCalendly from "@/Components/LawFirms/LawFirmCalendly.vue";
import LawFirmAppointment from "@/Components/LawFirms/Appointments/LawFirmAppointment.vue";
import LawFirmCertifications from "@/Components/LawFirms/Certifications/LawFirmCertifications.vue";
import LawFirmLawyers from "@/Components/LawFirms/Lawyers/LawFirmLawyers.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import LawFirmServices from "@/Components/LawFirms/Services/LawFirmServices.vue";
import LawFirmArchives from "@/Components/LawFirms/Archives/LawFirmArchives.vue";

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
    Link,
    LawFirmGeneralInfo,
    LawFirmSocialInfo,
    LawFirmBroadcasts,
    LawFirmPodcasts,
    LawFirmEvents,
    LawFirmProducts,
    LawFirmPosts,
    LawFirmArchives,
    LawFirmYoutube,
    LawFirmInstagram,
    LawFirmCalendly,
    LawFirmAppointment,
    LawFirmCertifications,
    LawFirmLawyers,
    Breadcrums,
    LawFirmServices
  },

  data() {
    return {
      active_tab: route().params.active_tab ?? "general-info",
      breadcrums: [
        {
          id: 1,
          name :this.__('home'),
          link: "/",
        },
        {
          id: 2,
          name: "Account",
          link: "",
        },
      ],
    };
  },

  methods: {
    changeTab(tab) {
      this.active_tab = tab;
      this.$inertia.replace(route("account"), {
        data: { active_tab: this.active_tab },
        preserveScroll: true,
      });
    },
    submit() {},
  },
});
</script>
