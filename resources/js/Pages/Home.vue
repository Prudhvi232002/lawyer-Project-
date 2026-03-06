<template>
    <app-layout title="Home" :showLoader="showLoader">
        <template #header>
            <section class="hero position-relative overflow-hidden">
                <Carousel :settings="settings" :breakpoints="breakpoints">
                    <Slide key="1">

                        <div class="container">
                            <div class="row w-100 py-5">
                                <div class="col-lg-6 col-md-12 text-start" data-aos="fade-right" data-aos-duration="1500">
                                    <div v-if="getPageContentType('main_heading_slide_1') == 'textarea'">
                                      <div class="text-white" v-html="getPageContent('main_heading_slide_1')"> </div>
                                    </div>
                                    <div v-else-if="getPageContentType('main_heading_slide_1') == 'text'">
                                        <p> {{getPageContent('main_heading_slide_1') ?? '-'}} </p>
                                    </div>
                                    <div v-else>
                                        <h1 class="text-white display-6">
                                        <small class="d-block fs-6 text-capitalize fw-normal">{{ __( "Your Legal Solution Just A Click Away" ) }}</small>
                                        {{ __("Online Consultation") }}
                                    </h1>
                                    <p class="text-white py-3 fs-6">
                                        <span class="hero-pulse py-3">
                                            <span class="text-primary">{{ __("27/7 Video") }} </span>
                                            {{  __( "Consultations, " ) }}
                                            <span class="text-primary">{{ __("Audio") }} </span>

                                            {{
                                                __("Calls + ")
                                            }}

                                            <span class="text-primary">{{ __("Chat") }} </span>

                                            {{
                                                __("Consultation")
                                            }}
                                        </span>
                                    </p>
                                    </div>
                                    <FindLawyerBar :home="true"></FindLawyerBar>
                                    <div v-if="getPageContentType('header_content_slide_1') == 'textarea'">
                                      <div class="text-white" v-html="getPageContent('header_content_slide_1')"> </div>
                                    </div>
                                    <div v-else-if="getPageContentType('header_content_slide_1') == 'text'">
                                        <p> {{getPageContent('header_content_slide_1') ?? '-'}} </p>
                                    </div>
                                    <p v-else class="mb-0 text-white mt-3 pe-md-4">
                                        Get professional legal advice from the
                                        comfort of your home with our virtual
                                        consultations. Connect with experienced
                                        lawyers online and find the answers you
                                        need for your legal matters. Convenient,
                                        confidential, and just a click away
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="d-md-flex justify-content-center d-none">
                                        <img src="@/images/home/lawfirmhero1.png" alt class="img-fluid" data-aos="fade"
                                            data-aos-once="false" data-aos-duration="2000" data-aos-delay="500" />
                                    </div>

                                    <div class="d-md-flex d-none align-items-center mt-4 position-relative">
                                        <img src="@/images/home/lawfirmshero.png" alt class="img-fluid me-4" data-aos="fade"
                                            data-aos-once="false" data-aos-duration="2000" data-aos-delay="1500"
                                            style="max-width: 320px" />
                                        <img src="@/images/home/lawfirmhero4.png" alt class="img-fluid" data-aos="fade"
                                            data-aos-once="false" data-aos-duration="2000" data-aos-delay="1000" style="
                                                max-width: 194px;
                                                position: absolute;
                                                right: -20px;
                                                top: -50px;
                                            " />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Slide>
                    <Slide key="2">
                        <div class="row py-5 align-items-center">
                            <div class="col-md-12 py-3 text-center" data-aos="fade-right" data-aos-duration="1500">
                                <div v-if="getPageContentType('header_content_slide_2') == 'textarea'">
                                      <div class="text-white" v-html="getPageContent('header_content_slide_2')"> </div>
                                    </div>
                                    <div v-else-if="getPageContentType('header_content_slide_2') == 'text'">
                                        <p> {{getPageContent('header_content_slide_2') ?? '-'}} </p>
                                    </div>
                                    <div v-else>
                                        <h1 class="text-white display-6">
                                    <small class="fw-normal fs-6 text-capitalize d-block">{{
                                        __("Trusted By Over Million Users")
                                    }}</small>
                                    {{ __("Online Law Firms ") }}
                                </h1>
                                <p class="text-white fs-6">
                                    {{
                                        __(
                                            "27/7 Video Consultations Audio Calls + Chat consultation "
                                        )
                                    }}
                                </p>
                                <div class="d-flex flex-md-row flex-column align-items-center justify-content-center mb-5">
                                    <div class="hero-pulse mb-md-0 mb-3 p-2 px-4 d-flex align-items-center me-4">
                                        <div class="circle pulse green me-4"></div>
                                        <span class="text-white" style="font-size: 11px">{{
                                            __("100+ online Law Firms")
                                        }}</span>
                                    </div>

                                    <div class="hero-pulse p-2 px-4 d-flex align-items-center">
                                        <div class="circle pulse yellow me-4"></div>
                                        <span class="text-white" style="font-size: 11px">{{
                                            __("50+ online Appointments")
                                        }}</span>
                                    </div>
                                </div>
                                    </div>


                                <FindLawFirmBar :home="true"></FindLawFirmBar>
                            </div>

                            <div class="col-12 text-center d-none d-lg-block mt-4">
                                <img src="@/images/home/lawfirmshero.png" style="max-width: 350px" alt class="img-fluid"
                                    data-aos="fade" data-aos-once="false" data-aos-duration="2000" data-aos-delay="1000" />
                            </div>

                            <div class="header-images d-none d-lg-block">
                                <img src="@/images/home/lawfirmhero1.png" alt class="img-fluid position-absolute"
                                    data-aos="fade" data-aos-once="false" data-aos-duration="2000" data-aos-delay="500" />
                                <img src="@/images/home/lawfirmhero2.png" alt class="img-fluid position-absolute"
                                    data-aos="fade" data-aos-once="false" data-aos-duration="2000" data-aos-delay="1000" />
                                <img src="@/images/home/lawfirmhero3.png" alt class="img-fluid position-absolute"
                                    data-aos="fade" data-aos-once="false" data-aos-duration="2000" data-aos-delay="1500" />
                                <img src="@/images/home/lawfirmhero4.png" alt class="img-fluid position-absolute"
                                    data-aos="fade" data-aos-once="false" data-aos-duration="2000" data-aos-delay="2000" />
                            </div>
                        </div>
                    </Slide>

                    <template #addons>
                        <!-- <Navigation /> -->
                        <Pagination class="mt-0 my-5" />
                    </template>
                </Carousel>
            </section>
        </template>

        <component
    v-for="(sectionKey, index) in home_section_sort"
    :key="index"
    :is="renderSection(sectionKey)"
/>
        <!-- <featured-tags-section class="bg-light"></featured-tags-section> -->
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import FindLawyerBar from "@/Components/Lawyers/FindLawyerBar.vue";
import FindLawFirmBar from "@/Components/LawFirms/FindLawFirmBar.vue";
import FindEventBar from "@/Components/Events/FindEventBar.vue";

import SpotlightLawyerSection from "@/Components/Lawyers/SpotlightLawyerSection.vue";
import HomeStatisticsBar from "@/Components/HomeStatisticsBar.vue";
import FeaturedTagsSection from "@/Components/Shared/FeaturedTagsSection.vue";
import FeaturedEventSection from "@/Components/Events/FeaturedEventSection.vue";
import LawyersTabsSection from "@/Components/Lawyers/LawyersTabs.vue";
import ServiceCategoriesSection from "@/Components/Lawyers/ServiceCategoriesSection.vue";
import FreeConsultationSection from "@/Components/Lawyers/FreeConsultationSection.vue";
import FaqsSection from "@/Components/Lawyers/FaqsSection.vue";
import AppSection from "@/Components/Lawyers/AppSection.vue";
import NearestTabSection from "@/Components/Lawyers/NearestTabSection.vue";
import FeaturedTestimonialsSection from "@/Components/Shared/FeaturedTestimonialsSection.vue";
import HomeStaticCardsSection from "@/Components/HomeStaticCardsSection.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Section from "@/Components/Section.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import FeaturedLawfirmSection from "@/Components/LawFirms/FeaturedLawFirmSection.vue";

export default defineComponent({
    components: {
        Head,
        Link,
        AppLayout,
        Navbar,
        FindLawyerBar,
        FindLawFirmBar,
        FindEventBar,
        HomeStatisticsBar,
        LawyersTabsSection,
        ServiceCategoriesSection,
        FreeConsultationSection,
        FaqsSection,
        AppSection,
        NearestTabSection,
        HomeStaticCardsSection,
        SpotlightLawyerSection,
        FeaturedTagsSection,
        FeaturedEventSection,
        FeaturedTestimonialsSection,
        FeaturedLawfirmSection,
        Carousel,
        Slide,
        Section,
        Pagination,
        Navigation,
    },
    props:['dashboard_data'],
    created() {
        this.home_section_sort = this.dashboard_data.components.length > 0 
        ? this.dashboard_data.components 
        : this.default_order;
      console.log(this.dashboard_data);
      

    },
    data: () => ({
       
        // carousel settings
        settings: {
            itemsToShow: 1,
            snapAlign: "start",
        },
        home_section_sort: [], // Initially empty
    default_order: [
        "HomeStatisticsBar",
        "HomeStaticCardsSection",
        "SpotlightLawyerSection",
        "NearestTabSection",
        "LawyersTabsSection",
        "FeaturedLawfirmSection",
        "ServiceCategoriesSection",
        "FreeConsultationSection",
        "FeaturedEventSection",
        "FeaturedTestimonialsSection",
        "AppSection",
        "FaqsSection",
    ],
        // breakpoints are mobile first
        // any settings not specified will fallback to the carousel settings
        breakpoints: {
            // 700px and up
            700: {
                itemsToShow: 1,
                snapAlign: "start",
            },
            // 1024 and up
            1024: {
                itemsToShow: 1,
                snapAlign: "start",
            },
        },
    }),

    methods: {
        readFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "read less";
                moreText.style.display = "inline";
            }
        },
        renderSection(sectionKey) {
        if (this.$options.components[sectionKey]) {
            return sectionKey;
        }
        console.warn(`Component "${sectionKey}" not found. Rendering fallback.`);
        return 'div'; 
    },
        
    },
});
</script>
<style>
#more {
    display: none;
}

.learn-more {
    width: 11rem;
}
</style>
