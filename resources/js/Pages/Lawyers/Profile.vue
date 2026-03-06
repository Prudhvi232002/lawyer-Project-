<template>
    <app-layout title="Profile">
        <template #header> </template>

        <div class="section py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12">
                    <img v-if="lawyer.cover_image" class="img-fluid" :src="lawyer.cover_image" alt="image" />

                        <div v-else class="cover-header rounded-2"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="profile-image mx-4 shadow rounded-2" style="background-color: #e4e4e4; max-height: 300px; ">
                            <img v-if="lawyer.image" class="img-fluid w-100 rounded" :src="lawyer.image" alt="image" style="object-fit: contain;" />
                            <img v-else class="img-fluid mt-4" src="@/images/account/default_avatar_men.png" alt="image" />
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-3">

                                <star-rating :rating="lawyer.rating" :star-size="16" :read-only="true" :increment="0.01"
                                    :show-rating="false"></star-rating>

                            <span class="text-muted small mt-1 ps-1">({{ lawyer.rating }}/5)</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                           <!-- <span class="d-flex text-primary" style="font-size: 14px;">
                            <i class="bi bi-circle-fill"></i> <span class="ms-1">Online</span>
                           </span> -->
                           <span class="d-flex text-muted" style="font-size: 14px;">
                            <i class="bi bi-circle-fill"></i> <span class="ms-1">Offline</span>
                           </span>
                        </div>
                        <h6 class="fw-bold text-center">{{ __("Share My Profile") }}</h6>
                         <ul class="social-share justify-content-center">
                         <li>
                             <a :href="'mailto:?subject=See My Profile&amp;body=Check out this Profile '+hostName()+'/lawyer/profile/'+lawyer.user_name" title="Share by Email"> <i class="bi bi-envelope"></i></a>
                         </li>
                         <li>
                             <a target="_blank" :href="'https://www.facebook.com/sharer.php?u='+hostName()+'/lawyer/profile/'+lawyer.user_name"><i  class="bi bi-facebook"></i></a>
                         </li>
                         <li>

                             <a target="_blank" :href="'https://api.whatsapp.com/send?text='+hostName()+'/lawyer/profile/'+lawyer.user_name"><i class="bi bi-whatsapp"></i></a>
                         </li>
                         <li>
                             <input type="text" class="border-0" style="visibility:hidden; width:0;" id="copyProfile" :value="hostName()+'/profile/'+lawyer.user_name">
                             <button type="button"  @click="copyProfile()" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover" class="position-absolute"><i class="bi bi-check2-all"></i></button>
                         </li>
                         <li>
                         <input type="url" id="website" class="border-0" style="visibility:hidden; width:0;" :value="hostName()+'/lawyer/profile/'+lawyer.user_name" name="website" :placeholder="hostName()" required />
                                 <button type="button" @click="generateQRCode()">
                                 <i class="bi bi-qr-code-scan"></i>
                         </button>
                         </li>
                         </ul>

                         <div id="qrcode-container" class="p-4 d-flex justify-content-center">
                             <div id="qrcode" class="qrcode"></div>
                         </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="card border-0 bg-transparent">
                            <div class="card-body p-0">
                                <div class="d-md-flex custom align-items-center justify-content-between mb-3 flex-wrap">
                                    <h2 class="mb-0 mb-md-0 fs-6 d-flex align-items-center text-capitalize">
                                        <i v-if="lawyer.is_featured" class="bi bi-patch-check-fill fs-5 me-2 text-secondary"></i>
                                        <span>{{ lawyer.name }} <small v-if="lawyer.law_firm_name" class="text-muted">({{ lawyer.law_firm_name }})</small></span>
                                        <span class="fw-normal small ps-1 ms-2" style="border-left:2px solid" v-if="lawyer.distance"> ( {{ formatDecimal(lawyer.distance) }} {{ __('km') }}) {{ __('away') }}</span>

                                    </h2>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <button v-if="lawyer.lawyer_settings
                                            .calendly_link
                                            "
                                            :onclick="`Calendly.initPopupWidget({url: '${lawyer.lawyer_settings.calendly_link}'});return false;`"
                                            class="btn btn-primary mt-2 mt-md-0">
                                            {{ __("book with calendly") }}
                                        </button>
                                        <div v-if="lawyer.appointment_types">
                                        <button  type="button" v-for="(schedule_type, index) in lawyer.appointment_types" :key="index"
                                            @click="checkLoginAndRedirect(lawyer, schedule_type.appointment_type)"
                                            class="ms-2 btn btn-primary mt-2 mt-md-0">
                                            {{
                                                __(schedule_type.appointment_type.display_name)
                                            }}
                                        </button>
                                            </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-start" >
                                    <ul class="list-unstyled mb-0">
                                        <li class="me-2 d-inline-block pe-2" style="font-size: 12px" v-for="(
                                                        cat, i
                                                    ) in lawyer.lawyer_categories" :key="cat.id" v-bind:class="{ 'border-end': i != lawyer.lawyer_categories.length - 1 }">
                                            {{ cat.name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div style="font-size: 14px" v-html="lawyer.description" class="text-start mb-3"></div>
                        <div class="row">
                            <div class="col-md-4 text-start" v-if="lawyer.experience">
                                <h6 class="fs-6">{{ __("experience") }}</h6>
                                <p class="mb-0" v-if="lawyer.experience == 1">{{ lawyer.experience }} {{ __("year") }}</p>
                                <p class="mb-0" v-else>{{ lawyer.experience }} {{ __("years") }}</p>
                            </div>

                            <div class="col-md-4 text-start" v-if="lawyer.speciality">
                                <h6 class="fs-6">{{ __("speciality") }}</h6>
                                <p class="mb-0">{{ lawyer.speciality }}</p>
                            </div>

                            <div class="col-md-4 text-start" v-if="checkObjectValuesIsNotNull(lawyer.lawyer_settings)">
                                <h6 class="fs-6">{{ __("socials") }}</h6>
                                <ul class="d-flex ps-0 mb-0">
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.facebook_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .facebook_url
                                            "><i class="bi text-dark bi-facebook"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.youtube_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .youtube_url
                                            "><i class="bi text-dark bi-youtube"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.twitter_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .twitter_url
                                            "><i class="bi text-dark bi-twitter"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.linkedin_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .linkedin_url
                                            "><i class="bi text-dark bi-linkedin"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.whatsapp_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .whatsapp_url
                                            "><i class="bi text-dark bi-whatsapp"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.instagram_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .instagram_url
                                            "><i class="bi text-dark bi-instagram"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0"
                                        v-if="lawyer.lawyer_settings.tiktok_url">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .tiktok_url
                                            "><i class="bi text-dark bi-tiktok"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.snapchat_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .snapchat_url
                                            "><i class="bi text-dark bi-snapchat"></i></a>
                                    </li>
                                    <li class="list-group-item px-1 bg-transparent border-0" v-if="lawyer.lawyer_settings.pinterest_url
                                        ">
                                        <a target="_blank" :href="lawyer.lawyer_settings
                                            .pinterest_url
                                            "><i class="bi text-dark bi-pinterest"></i></a>
                                    </li>
                                </ul>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>



        <profile-section :href="route('broadcasts.listing', { lawyer: lawyer.user_name })" v-if="hasModule(
            'lawyer-list-services',
            'lawyer',
            lawyer.lawyer_modules
        ) && lawyer.lawyer_broadcasts.length > 0
            " :heading="lawyer.name + ' ' + __n('broadcast')">
            <broadcast-card v-for="broadcast in lawyer.lawyer_broadcasts" :broadcast="broadcast"
                :key="broadcast.id"></broadcast-card>
        </profile-section>

        <!-- <profile-section :heading="lawyer.name + ' ' + __n('product')">
            <lawyer-product-card></lawyer-product-card>
            <lawyer-product-card></lawyer-product-card>
            <lawyer-product-card></lawyer-product-card>
            <lawyer-product-card></lawyer-product-card>
        </profile-section> -->

        <profile-section :outer_href="lawyer.lawyer_settings.youtube_channel_link"
            v-if="lawyer.lawyer_settings.youtube_playlist_link" :heading="lawyer.name + ' ' + __n('youtube')">
            <iframe width="560" height="315" :src="lawyer.lawyer_settings.youtube_playlist_link" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </profile-section>

        <profile-section :href="route('podcasts.listing', { lawyer: lawyer.user_name })"
            v-if="lawyer.lawyer_podcasts.length > 0" :heading="lawyer.name + ' ' + __n('podcast')">
            <podcast-card v-for="podcast in lawyer.lawyer_podcasts" :podcast="podcast" :key="podcast.id"></podcast-card>
        </profile-section>

        <profile-section :href="route('archives.listing', { lawyer: lawyer.user_name })"
            v-if="lawyer.lawyer_archives.length > 0" :heading="lawyer.name + ' ' + __n('archive')">
            <archive-card v-for="archive in lawyer.lawyer_archives" :archive="archive" :key="archive.id">
            </archive-card>
        </profile-section>

        <!-- <profile-section :outer_href="lawyer.lawyer_settings.instagram_profile_link"
            v-if="lawyer.lawyer_settings.instagram_access_token" :heading="lawyer.name + ' ' + __n('instagram')">
            <InstagramFeed :count="10" :accessToken="lawyer.lawyer_settings.instagram_access_token" :pagination="false"
                :caption="true" />
        </profile-section> -->

        <profile-section :href="route('blogs.listing', { lawyer: lawyer.user_name })" v-if="lawyer.lawyer_posts.length > 0"
            :heading="lawyer.name + ' ' + __n('blog')">
            <post-card v-for="post in lawyer.lawyer_posts" :post="post" :key="post.id"></post-card>
        </profile-section>

        <profile-section :href="route('events.listing', { lawyer: lawyer.user_name })"
            v-if="lawyer.lawyer_events.length > 0" :heading="lawyer.name + ' ' + __n('event')">
            <event-card class="mb-4" :add_col="true" v-for="event in lawyer.lawyer_events" :event="event"
                :key="event.id"></event-card>
        </profile-section>
        <profile-section :href="route('services.listing', { lawyer: lawyer.user_name })"
            v-if="lawyer.lawyer_services.length > 0" :heading="lawyer.name + ' ' + __n('service')">
            <service-card class="mb-4" :add_col="true" v-for="service in lawyer.lawyer_services" :service="service"
                :key="service.id"></service-card>
        </profile-section>

        <lawyer-profile-reviews-section :lawyer_id="lawyer.id" :lawyer="lawyer"
            :reviews="lawyer.lawyer_reviews"></lawyer-profile-reviews-section>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import LawyerAccount from "@/Components/Lawyers/LawyerAccount.vue";
import BroadcastCard from "@/Components/Broadcasts/BroadcastCard.vue";
import PodcastCard from "@/Components/Podcasts/PodcastCard.vue";
import PostCard from "@/Components/Posts/PostCard.vue";
import LawyerProductCard from "@/Components/Lawyers/LawyerProductCard.vue";
import ArchiveCard from "@/Components/Archives/ArchiveCard.vue";
import EventCard from "@/Components/Events/EventCard.vue";
import ServiceCard from "@/Components/Services/ServiceCard.vue";
import ProfileSection from "@/Components/Shared/ProfileSection.vue";
import LawyerProfileReviewsSection from "@/Components/Lawyers/LawyerProfileReviewsSection.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        LawyerAccount,
        BroadcastCard,
        PodcastCard,
        ProfileSection,
        PostCard,
        LawyerProductCard,
        ArchiveCard,
        EventCard,
        ServiceCard,
        LawyerProfileReviewsSection,
        Head,
        Link,

    },
    data() {
        return {
            lawyer: this.$page.props.lawyer,
        };
    },
    mounted() {

     },
    props: ["appointment_types"],
    methods: {
        checkLoginAndRedirect(lawyer, appointment_type) {
            if (this.$page.props.auth) {
                if (this.$page.props.auth.logged_in_as == 'customer') {
                    this.$inertia.visit(route(
                        'lawyer.book_appointment',
                        {
                            user_name: lawyer.user_name,
                            type: appointment_type.type,
                        }
                    ))
                }
                else {
                    this.$toast.warning("You must log in as a customer");
                }

            } else {
                this.$toast.warning("Please login first");
                this.$inertia.visit(route("login"), {
                    data: {
                        'is_redirect': 1
                    },
                });
            }
        },
        submit() { },
        logEvent(evt) {

            // Here you can handle the emitted events with custom code
            if (evt === "calendly.profile_page_viewed") {
            }
        },
        copyProfile() {
      // Get the text field
      var copyText = document.getElementById("copyProfile");

      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices

      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
      this.$toast.success("Profile link copied to Clipboard");

    },

    generateQRCode(){

      let website = document.getElementById("website").value;
      let qrcodeContainer = document.getElementById("qrcode");
      var isToggled = qrcodeContainer.innerHTML === "" ? false : true;
      if (website && !isToggled) {
        let qrcodeContainer = document.getElementById("qrcode");
        qrcodeContainer.innerHTML = "";
        new QRCode(qrcodeContainer, {
          text: website,
          width: 128,
          height: 128,
          colorDark: "rgb(38, 41, 41)",
          colorLight: "#ffffff",
          correctLevel: QRCode.CorrectLevel.H
        });
        /*With some styles*/
        // let qrcodeContainer2 = document.getElementById("qrcode-2");
        // qrcodeContainer2.innerHTML = "";
        // new QRCode(qrcodeContainer2, {
        //   text: website,
        //   width: 128,
        //   height: 128,
        //   colorDark: "#5868bf",
        //   colorLight: "#ffffff",
        //   correctLevel: QRCode.CorrectLevel.H
        // });
        document.getElementById("qrcode-container").style.display = "block";
      } else {
        qrcodeContainer.innerHTML = "";
       // alert("Please enter a valid URL");
      }
    },
    },
});
</script>
<style>
.instagram-wrapper {
    max-width: 93.5rem;
    margin: 0 auto;
    padding: 0 2rem;
}

.instagram-gallery {
    display: flex;
    flex-wrap: wrap;
    margin: -1rem, -1rem;
    padding-bottom: 3rem;
}

.instagram-gallery-item {
    position: relative;
    flex: 1 0 22rem;
    margin: 1rem;
    color: #fff;
    cursor: pointer;
}

.instagram-gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
