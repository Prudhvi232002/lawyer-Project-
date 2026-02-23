<template>
    <div class="container-fluid py-5 border-bottom border-dark">
        <div class="row">
            <div class="col-12">
                <h2 class="fs-2 text-center">

                    <span class="fw-normal">{{ __('hello') }} {{ $page.props.auth.user.name }} |</span>
                    <span class="fw-bold"> {{ __('set profile') }}</span>
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
                    <div class="nav flex-column nav-pills account-tabs" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <li class="nav-item mb-3" role="presentation">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'general-info' }"
                                @click="changeTab('general-info')" id="general-info-tab" data-bs-toggle="tab"
                                data-bs-target="#general-info" type="button" role="tab" aria-controls="general-info"
                                aria-selected="true">{{ __('general info') }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-social-info', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'social-info' }"
                                @click="changeTab('social-info')" id="social-info-tab" data-bs-toggle="tab"
                                data-bs-target="#social-info" type="button" role="tab" aria-controls="social-info"
                                aria-selected="true">{{ __('social info') }}</button>
                        </li>
                        <!-- v-if="hasModule('test')" -->
                        <li class="nav-item mb-3" role="presentation">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'certifications' }"
                                @click="changeTab('certifications')" id="certifications-tab" data-bs-toggle="tab"
                                data-bs-target="#certifications" type="button" role="tab" aria-controls="certifications"
                                aria-selected="false">{{ __('certifications') }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-broadcasts', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'broadcasts' }"
                                @click="changeTab('broadcasts')" id="broadcasts-tab" data-bs-toggle="tab"
                                data-bs-target="#broadcasts" type="button" role="tab" aria-controls="broadcasts"
                                aria-selected="false">{{ __n('broadcast') }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-podcasts', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'podcasts' }"
                                @click="changeTab('podcasts')" id="podcasts-tab" data-bs-toggle="tab"
                                data-bs-target="#podcasts" type="button" role="tab" aria-controls="podcasts"
                                aria-selected="false">{{ __n('podcast') }}</button>
                        </li>
                        <!-- <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-services', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'services' }"
                                @click="changeTab('services')" id="services-tab" data-bs-toggle="tab"
                                data-bs-target="#services" type="button" role="tab" aria-controls="services"
                                aria-selected="false">{{ __n('service') }}</button>
                        </li> -->
                        <li class="nav-item mb-3" role="presentation">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'services' }"
                                @click="changeTab('services')" id="services-tab" data-bs-toggle="tab"
                                data-bs-target="#services" type="button" role="tab" aria-controls="services"
                                aria-selected="false">{{ __n('service') }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-events', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'events' }"
                                @click="changeTab('events')" id="events-tab" data-bs-toggle="tab"
                                data-bs-target="#events" type="button" role="tab" aria-controls="events"
                                aria-selected="false">{{ __n('event') }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'youtube' }"
                                @click="changeTab('youtube')" id="youtube-tab" data-bs-toggle="tab"
                                data-bs-target="#youtube" type="button" role="tab" aria-controls="youtube"
                                aria-selected="false">{{ __('youtube') }}</button>
                        </li>
                        <!-- <li class="nav-item mb-3" role="presentation">
              <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'instagram' }"
                @click="changeTab('instagram')" id="instagram-tab" data-bs-toggle="tab" data-bs-target="#instagram"
                type="button" role="tab" aria-controls="instagram" aria-selected="false">{{ __('instagram') }}</button>
            </li> -->
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-calendly', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'calendly' }"
                                @click="changeTab('calendly')" id="calendly-tab" data-bs-toggle="tab"
                                data-bs-target="#calendly" type="button" role="tab" aria-controls="calendly"
                                aria-selected="false">{{ __('calendly') }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-appointment', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'appointment' }"
                                @click="changeTab('appointment')" id="appointment-tab" data-bs-toggle="tab"
                                data-bs-target="#appointment" type="button" role="tab" aria-controls="appointment"
                                aria-selected="false">{{ __('appointment')
                                }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-blogs', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'blogs' }"
                                @click="changeTab('blogs')" id="blogs-tab" data-bs-toggle="tab" data-bs-target="#blogs"
                                type="button" role="tab" aria-controls="blogs" aria-selected="false">{{ __n('blog')
                                }}</button>
                        </li>
                        <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-archives', 'lawyer')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'archives' }"
                                @click="changeTab('archives')" id="archives-tab" data-bs-toggle="tab"
                                data-bs-target="#archives" type="button" role="tab" aria-controls="archives"
                                aria-selected="false">{{ __n('archive') }}</button>
                        </li>
                        <li class="nav-item"><a :href="route('lawyer.my_profile')" class="nav-link" target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i> {{ __('preview profile') }} </a></li>

                    </div>
                </div>
                <div class="col-md-9 border-start border-dark">
                    <!-- Nav tabs -->


                    <!-- v-if="hasModule('test')" -->
                    <!-- Tab panes -->
                    <div class="tab-content w-100 p-4" id="v-pills-tabContent">
                        <lawyer-general-info v-if="active_tab == 'general-info'"
                            :active="active_tab == 'general-info'"></lawyer-general-info>
                        <lawyer-social-info
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-social-info', 'lawyer') && active_tab == 'social-info'"
                            :active="active_tab == 'social-info'"></lawyer-social-info>
                        <lawyer-certifications v-if="active_tab == 'certifications'"
                            :active="active_tab == 'certifications'"></lawyer-certifications>
                        <lawyer-broadcasts
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-broadcasts', 'lawyer') && active_tab == 'broadcasts'"
                            :active="active_tab == 'broadcasts'"></lawyer-broadcasts>
                        <lawyer-podcasts
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-podcasts', 'lawyer') && active_tab == 'podcasts'"
                            :active="active_tab == 'podcasts'"></lawyer-podcasts>
                        <!-- <lawyer-services
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-services', 'lawyer') && active_tab == 'services'"
                            :active="active_tab == 'services'"></lawyer-services> -->
                        <lawyer-services

                            :active="active_tab == 'services'"></lawyer-services>
                        <lawyer-events
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-events', 'lawyer') && active_tab == 'events'"
                            :active="active_tab == 'events'"></lawyer-events>
                        <lawyer-products
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-products', 'lawyer') && active_tab == 'products'"
                            :active="active_tab == 'products'"></lawyer-products>
                        <lawyer-youtube v-if="active_tab == 'youtube'"
                            :active="active_tab == 'youtube'"></lawyer-youtube>
                        <lawyer-instagram v-if="active_tab == 'instagram'"
                            :active="active_tab == 'instagram'"></lawyer-instagram>
                        <lawyer-calendly
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-calendly', 'lawyer') && active_tab == 'calendly'"
                            :active="active_tab == 'calendly'"></lawyer-calendly>
                        <lawyer-appointment
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-appointment', 'lawyer') && active_tab == 'appointment'"
                            :active="active_tab == 'appointment'"></lawyer-appointment>
                        <lawyer-posts
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-blogs', 'lawyer') && active_tab == 'blogs'"
                            :active="active_tab == 'blogs'"></lawyer-posts>
                        <lawyer-archives
                            v-if="!isSubscriptionEnabled() || hasModule('lawyer-archives', 'lawyer') && active_tab == 'archives'"
                            :active="active_tab == 'archives'"></lawyer-archives>
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
import LawyerGeneralInfo from "@/Components/Lawyers/LawyerGeneralInfo.vue";
import LawyerSocialInfo from "@/Components/Lawyers/LawyerSocialInfo.vue";
import LawyerBroadcasts from "@/Components/Lawyers/Broadcasts/LawyerBroadcasts.vue";
import LawyerPodcasts from "@/Components/Lawyers/Podcasts/LawyerPodcasts.vue";
import LawyerServices from "@/Components/Lawyers/Services/LawyerServices.vue";
import LawyerEvents from "@/Components/Lawyers/Events/LawyerEvents.vue";
import LawyerPosts from "@/Components/Lawyers/Posts/LawyerPosts.vue";
import LawyerProducts from "@/Components/Lawyers/LawyerProducts.vue";
import LawyerYoutube from "@/Components/Lawyers/LawyerYoutube.vue";
import LawyerInstagram from "@/Components/Lawyers/LawyerInstagram.vue";
import LawyerCalendly from "@/Components/Lawyers/LawyerCalendly.vue";
import LawyerAppointment from "@/Components/Lawyers/Appointments/LawyerAppointment.vue";
import LawyerCertifications from "@/Components/Lawyers/Certifications/LawyerCertifications.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

import LawyerArchives from "@/Components/Lawyers/Archives/LawyerArchives.vue";

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
        LawyerGeneralInfo,
        LawyerSocialInfo,
        LawyerBroadcasts,
        LawyerPodcasts,
        LawyerServices,
        LawyerEvents,
        LawyerProducts,
        LawyerPosts,
        LawyerArchives,
        LawyerYoutube,
        LawyerInstagram,
        LawyerCalendly,
        LawyerAppointment,
        LawyerCertifications,
        Breadcrums
    },

    data() {
        return {
            active_tab: route().params.active_tab ?? "general-info",
            breadcrums: [
                {
                    id: 1,
                    name: this.__('home'),
                    link: '/'
                },
                {
                    id: 2,
                    name: this.__('account'),
                    link: ''
                }
            ]
        };
    },

    methods: {
        changeTab(tab) {
            this.active_tab = tab;
            this.$inertia.replace(route("account"), {
                data: { active_tab: this.active_tab },
                preserveScroll: true
            });
        },
        submit() { }
    }
});
</script>
