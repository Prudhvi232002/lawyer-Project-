<template>
  <app-layout title="My Profile">
    <div class="section py-5">
      <div class="container">
        <div class="row mb-4">
          <div class="col-12">
            <img
              v-if="law_firm.cover_image"
              class="img-fluid"
              :src="law_firm.cover_image"
              alt="image"
              style="width: 100%; height: 300px;"
            />
            <div v-else class="cover-header rounded-2"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-12">
            <!-- <i
              v-if="law_firm.is_featured"
              class="bi text-primary bi-patch-check-fill ms-2 fs-2"
              style="z-index: 2"
            ></i> -->

            <Link
              :href="
                route('law_firm.profile', {
                  user_name: law_firm.user_name,
                })
              "
            >
              <div
                class="profile-image mx-4 shadow rounded-2 position-relative"
                style="background-color: rgb(228, 228, 228);max-height: 300px"
              >
                <img
                  v-if="law_firm.image"
                  class="img-fluid img-fluid w-100 rounded"
                  :src="law_firm.image"
                  alt="law"
                  style="object-fit: contain;"
                />
                <img
                  v-if="!law_firm.image"
                  class="img-fluid"
                  src="@/images/account/default_avatar_men.png"
                  alt="law"
                  style="object-fit: contain;"
                />

              </div>
            </Link>
            <div class="d-flex align-items-center justify-content-md-center me-4 mt-3"
                >
                  <span class="mt-1 me-2 text-muted"
                    > ({{ law_firm.rating }}/5)</span
                  >
                  <span class="text-white" style="color: #f5d812">
                    <star-rating
                      :rating="law_firm.rating"
                      :star-size="18"
                      :read-only="true"
                      :increment="0.01"
                      :show-rating="false"
                    ></star-rating>
                  </span>
                </div>
                <span class="d-flex justify-content-center text-muted" style="font-size: 14px;">
                            <i class="bi bi-circle-fill"></i> <span class="ms-1">Offline</span>
                           </span>
                           <div class="col-md-12 text-center">
              <h6 class="fw-bold my-3">{{ __("Share My Profile") }}</h6>
                <ul class="social-share justify-content-center">
                    <li>
                        <a :href="'mailto:?subject=See My Profile&amp;body=Check out this Profile '+hostName()+'/law_firm/profile/'+law_firm.user_name" title="Share by Email"> <i class="bi bi-envelope"></i></a>
                    </li>
                    <li>
                        <a target="_blank" :href="'https://www.facebook.com/sharer.php?u='+hostName()+'/law_firm/profile/'+law_firm.user_name"><i  class="bi bi-facebook"></i></a>
                    </li>
                    <li>

                        <a target="_blank" :href="'https://api.whatsapp.com/send?text='+hostName()+'/law_firm/profile/'+law_firm.user_name"><i class="bi bi-whatsapp"></i></a>
                    </li>
                    <li>
                        <input type="text" class="border-0" style="visibility:hidden; width:0;" id="copyProfile" :value="hostName()+'/profile/'+law_firm.user_name">
                        <button type="button"  @click="copyProfile()" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover" class="position-absolute"><i class="bi bi-check2-all"></i></button>
                    </li>
                    <li>
                    <input type="url" id="website" class="border-0" style="visibility:hidden; width:0;" :value="hostName()+'/law_firm/profile/'+law_firm.user_name" name="website" :placeholder="hostName()" required />
                            <button type="button" @click="generateQRCode()">
                            <i class="bi bi-qr-code-scan"></i>
                    </button>
                    </li>
                </ul>

                <div id="qrcode-container" class="p-4 d-flex justify-content-center">
                    <div id="qrcode" class="qrcode"></div>
                </div>
            </div>

          </div>
          <div class="col-lg-9 col-md-12">
            <div class="d-md-flex align-items-center justify-content-between mb-3">
              <div class="d-flex mb-md-0 mb-3 flex-column align-items-start">
                <h2 class="mb-0 fs-5 text-capitalize">
                  <i
                    v-if="law_firm.is_featured"
                    class="bi text-primary bi-patch-check-fill me-2 fs-5"
                  ></i>
                  <Link
                    :href="
                      route('law_firm.profile', {
                        user_name: law_firm.user_name,
                      })
                    "
                    class="text-decoration-none text-dark fs-6"
                    >{{ law_firm.name }}</Link
                  >
                </h2>
              </div>
              <div class="d-flex align-items-center">
                <button
                  v-if="law_firm.law_firm_settings.calendly_link"
                  :onclick="`Calendly.initPopupWidget({url: '${law_firm.law_firm_settings.calendly_link}'});return false;`"
                  class="btn btn-primary"
                >
                  {{ __("book with calendly") }}
                </button>

                <div v-if="law_firm.appointment_types">
                  <button
                    type="button"
                    v-for="(schedule_type, index) in law_firm.appointment_types"
                    :key="index"
                    @click="
                      checkLoginAndRedirect(
                        law_firm,
                        schedule_type.appointment_type
                      )
                    "
                    class="ms-2 btn btn-primary"
                  >
                    {{ __(schedule_type.appointment_type.display_name) }}
                  </button>
                </div>
              </div>
            </div>

            <div
              class="my-2 d-flex align-items-csnter"
              v-if="law_firm.law_firm_categories.length > 0"
            >
            <span class="fw-bold"> {{ __("speciality") }}:</span>
              <ul class="list-unstyled d-md-flex align-items-center ms-3 mb-0">
                <li
                  v-for="(category, index) in law_firm.law_firm_categories"
                  :key="index"
                  class="me-3 pe-3 border-end"
                  style="font-size: 12px"
                >
                  {{ category.name }}
                </li>
              </ul>
            </div>
            <div style="font-size: 14px" class="text-start">
              <p>{{ law_firm.description }}</p>
            </div>

            <div class="row mt-3">
              <!-- <div class="col-md-4 text-start">

              </div> -->

              <div class="col-md-5 text-start" v-if="checkObjectValuesIsNotNull(law_firm.law_firm_settings)">
                <div class="d-flex flex-column align-items-start">
                  <h6 class="fs-6 fw-bold text-capitalize">
                    {{ __("socials") }}
                  </h6>
                  <ul
                    class="d-flex flex-wrap justify-content-end ps-0 mb-0 list-group list-group-horizontal"
                  >
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.facebook_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.facebook_url"
                        ><i class="bi bi-facebook"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.youtube_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.youtube_url"
                        ><i class="bi bi-youtube"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.twitter_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.twitter_url"
                        ><i class="bi bi-twitter"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.linkedin_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.linkedin_url"
                        ><i class="bi bi-linkedin"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.whatsapp_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.whatsapp_url"
                        ><i class="bi bi-whatsapp"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.instagram_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.instagram_url"
                        ><i class="bi bi-instagram"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.tiktok_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.tiktok_url"
                        ><i class="bi bi-tiktok"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.snapchat_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.snapchat_url"
                        ><i class="bi bi-snapchat"></i
                      ></a>
                    </li>
                    <li
                      class="list-group-item p-1 py-0 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.pinterest_url"
                    >
                      <a
                        target="_blank"
                        class="text-dark"
                        :href="law_firm.law_firm_settings.pinterest_url"
                        ><i class="bi bi-pinterest"></i
                      ></a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="stats my-5 py-3">
        <div class="container">
          <div class="row mx-0 align-items-center">
            <div class="col-md-4 text-center text-md-start">
              <span class="fs-3"
                >Why Choose <br />
                {{ law_firm.name }}</span
              >
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                  <div
                    class="d-flex align-items-center justify-content-center item aos-init aos-animate"
                  >
                    <i class="bi bi bi-person-fill"></i>
                    <div class="d-flex flex-column ms-3">
                      <h3 class="mb-0">
                        {{ law_firm.law_firm_lawyers.length }}
                        <span v-if="law_firm.law_firm_lawyers.length > 0"
                          >+</span
                        >
                      </h3>
                      <span class="">{{ __("Lawyers") }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div
                    class="d-flex align-items-center justify-content-center item aos-init aos-animate"
                  >
                    <i class="bi bi bi-people-fill"></i>
                    <div class="d-flex flex-column ms-3">
                      <h3 class="mb-0">
                        {{ law_firm.booked_appointments }}
                        <span v-if="law_firm.booked_appointments > 0">+</span>
                      </h3>
                      <span class="">{{ __("Users") }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div
                    class="d-flex align-items-center justify-content-center item aos-init aos-animate"
                  >
                    <i class="bi bi bi-calendar-x"></i>
                    <div class="d-flex flex-column ms-3">
                      <h3 class="mb-0">
                        {{ law_firm.law_firm_events.length }}
                        <span v-if="law_firm.law_firm_events.length > 0"
                          >+</span
                        >
                      </h3>
                      <span class="">{{ __("events") }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div
          class="row pt-3 law-firm-lawyer"
          v-if="law_firm.law_firm_lawyers.length > 0"
        >
          <div class="col-12 mb-4 text-center">
            <span class="fs-3">{{ law_firm.name }}</span>
            <h2 class="display-6">{{ __("associate lawyers") }}</h2>
          </div>

          <div class="col-12">
            <featured-lawfirm-lawyer-section
              class="pt-2"
              findLawyers="true"
              :law_firm_lawyers="law_firm.law_firm_lawyers"
            ></featured-lawfirm-lawyer-section>
          </div>
        </div>
      </div>
    </div>

    <profile-section
      :href="route('broadcasts.listing', { law_firm: law_firm.user_name })"
      v-if="law_firm.law_firm_broadcasts.length > 0"
      :heading="law_firm.name + ' ' + __n('broadcast')"
    >
      <broadcast-card
        v-for="broadcast in law_firm.law_firm_broadcasts"
        :broadcast="broadcast"
        :key="broadcast.id"
      ></broadcast-card>
    </profile-section>

    <profile-section
      :href="route('podcasts.listing', { law_firm: law_firm.user_name })"
      v-if="law_firm.law_firm_podcasts.length > 0"
      :heading="law_firm.name + ' ' + __n('podcast')"
    >
      <podcast-card
        v-for="podcast in law_firm.law_firm_podcasts"
        :podcast="podcast"
        :key="podcast.id"
      ></podcast-card>
    </profile-section>

    <!-- <profile-section :heading="law_firm.name + ' ' + __n('product')">
            <law_firm-product-card></law_firm-product-card>
            <law_firm-product-card></law_firm-product-card>
            <law_firm-product-card></law_firm-product-card>
            <law_firm-product-card></law_firm-product-card>
        </profile-section> -->

    <profile-section
      :outer_href="law_firm.law_firm_settings.youtube_channel_link"
      v-if="law_firm.law_firm_settings.youtube_playlist_link"
      :heading="law_firm.name + ' ' + __n('youtube')"
    >
      <iframe
        width="560"
        height="550"
        :src="law_firm.law_firm_settings.youtube_playlist_link"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen
      ></iframe>
    </profile-section>

    <!-- <profile-section
      :outer_href="law_firm.law_firm_settings.instagram_profile_link"
      v-if="law_firm.law_firm_settings.instagram_access_token"
      :heading="law_firm.name + ' ' + __n('instagram')"
    >
      <InstagramFeed
        :count="4"
        :accessToken="law_firm.law_firm_settings.instagram_access_token"
        :pagination="true"
        :caption="true"
      />
    </profile-section> -->

    <profile-section
      class="bg-light"
      :href="route('blogs.listing', { law_firm: law_firm.user_name })"
      v-if="law_firm.law_firm_posts.length > 0"
      :heading="law_firm.name + ' ' + __n('blog')"
    >
      <post-card
        v-for="post in law_firm.law_firm_posts"
        :post="post"
        :key="post.id"
      ></post-card>
    </profile-section>

    <profile-section
      :href="route('events.listing', { law_firm: law_firm.user_name })"
      v-if="law_firm.law_firm_events.length > 0"
      :heading="law_firm.name + ' ' + __n('event')"
    >
      <event-card
        :add_col="true"
        v-for="event in law_firm.law_firm_events"
        :event="event"
        :key="event.id"
      ></event-card>
    </profile-section>

    <profile-section
      :href="route('archives.listing', { law_firm: law_firm.user_name })"
      v-if="law_firm.law_firm_archives.length > 0"
      background_color="#EDE6F2"
      :heading="law_firm.name + ' ' + __n('archive')"
    >
      <archive-card
        v-for="archive in law_firm.law_firm_archives"
        :archive="archive"
        :key="archive.id"
      >
      </archive-card>
    </profile-section>

    <law_firm-profile-reviews-section
      :law_firm_id="law_firm.id"
      :law_firm="law_firm"
      :reviews="law_firm.law_firm_reviews"
    ></law_firm-profile-reviews-section>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import LawFirmAccount from "@/Components/LawFirms/LawFirmAccount.vue";
import BroadcastCard from "@/Components/Broadcasts/BroadcastCard.vue";
import PodcastCard from "@/Components/Podcasts/PodcastCard.vue";
import PostCard from "@/Components/Posts/PostCard.vue";
import LawFirmProductCard from "@/Components/LawFirms/LawFirmProductCard.vue";
import ArchiveCard from "@/Components/Archives/ArchiveCard.vue";
import EventCard from "@/Components/Events/EventCard.vue";
import ProfileSection from "@/Components/Shared/ProfileSection.vue";
import LawFirmProfileReviewsSection from "@/Components/LawFirms/LawFirmProfileReviewsSection.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import FeaturedLawfirmLawyerSection from "@/Components/LawFirms/FeaturedLawFirmLawyerSection.vue";
export default defineComponent({
  components: {
    Head,
    Link,
    AppLayout,
    Navbar,
    PageHeader,
    LawFirmAccount,
    BroadcastCard,
    PodcastCard,
    ProfileSection,
    PostCard,
    LawFirmProductCard,
    ArchiveCard,
    EventCard,
    LawFirmProfileReviewsSection,
    FeaturedLawfirmLawyerSection,
  },
  data() {
    return {
      law_firm: this.$page.props.law_firm,
    };
  },
  mounted() {},
  props: ["appointment_types"],
  methods: {
    checkLoginAndRedirect(law_firm, appointment_type) {
      if (this.$page.props.auth) {
        if (this.$page.props.auth.logged_in_as == "customer") {
          this.$inertia.visit(
            route("law_firm.book_appointment", {
              user_name: law_firm.user_name,
              type: appointment_type.type,
            })
          );
        } else {
          this.$toast.warning("You must log in as a customer");
        }
      } else {
        this.$toast.warning("Please login first");
        this.$inertia.visit(route("login"), {
          data: {
            is_redirect: 1,
          },
        });
      }
    },
    submit() {},
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
