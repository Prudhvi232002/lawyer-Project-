<template>
  <div class="w-100 listView" :class="{ 'item': add_col }">
    <div class="card spotlight-card item-h border-0 p-3 bg-transparent shadow-none">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-3 col-md-12 position-relative">

            <Link class="text-decoration-none" :href="route('law_firm.profile', { 'user_name': law_firm.user_name })">
            <div class="d-flex justify-content-center overflow-hidden position-relative"
              style="height: 205px;">
              <img v-if="law_firm.image" class="img-fluid" :src="law_firm.image" alt="law_firm" />
              <img v-if="!law_firm.image" class="img-fluid" src="@/images/account/default_avatar_men.png"
                alt="law_firm" />
              <!-- <div class="item-overlay top">
                  <Link :href="route('law_firm.profile', { 'user_name': law_firm.user_name })"
                    class="btn rounded-5 border-0 text-dark px-4 btn-primary">View Lawyers</Link>
                </div> -->
            </div>
            </Link>
            <div class="d-flex align-items-center justify-content-center mt-1">

              <star-rating :rating="law_firm.rating" :star-size="16" :read-only="true" :increment="0.01"
                :show-rating="false"></star-rating>
              <span class="text-dark small mt-1 ps-1">({{ law_firm.rating }}/5)</span>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-2">
              <span v-if="law_firm.is_online" class="d-flex text-primary" style="font-size: 14px;">
                <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_online_text') ?? 'Online' }}</span>
              </span>
              <span v-else class="d-flex text-muted" style="font-size: 14px;">
                <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_offline_text') ?? 'Offline' }}</span>
              </span>
            </div>
          </div>
          <div class="col-lg-9 col-md-12">
            <div class="d-md-flex align-items-center justify-content-between mb-3">
              <div class="d-flex custom mb-md-0 mb-3 align-items-start justify-content-center justify-content-lg-start">
                <h2 class="mb-0 fs-6 text-dark d-flex align-items-center text-capitalize">
                  <i v-if="law_firm.is_featured" class="bi bi-patch-check-fill fs-5 me-2 text-secondary"></i>
                  <Link class="text-decoration-none text-dark"
                    :href="route('law_firm.profile', { user_name: law_firm.user_name, })">{{ law_firm.name }}
                  </Link>
                  <span class="fw-normal small ps-1 ms-2" style="border-left:2px solid" v-if="law_firm.distance"> ( {{
                    formatDecimal(law_firm.distance) }} {{ __('km') }}) {{ __('away') }}</span>
                </h2>

              </div>
              <div class="d-md-flex d-grid align-items-center">

                <Link :href="route('law_firm.profile', { user_name: law_firm.user_name, })"
                  class="btn btn-primary btn-sm">
                  {{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}
                </Link>
              </div>
            </div>

            <div class="mb-3 text-start" v-if="law_firm.law_firm_categories && law_firm.law_firm_categories.length > 0">
              <ul class="list-unstyled mb-0">
                <li class="me-2 d-inline-block pe-2" style="font-size: 12px"
                  v-for="(cat, i) in law_firm.law_firm_categories" :key="cat.id"
                  v-bind:class="{ 'border-end': i != law_firm.law_firm_categories.length - 1 }">
                  {{ cat.name }}
                </li>
              </ul>
            </div>
            <div style="font-size: 14px" v-html="law_firm.description" class="text-start desc mb-3"></div>
            <div class="row">
              <div class="col-lg-6 text-start" v-if="checkObjectValuesIsNotNull(law_firm.law_firm_settings)">
                <div class="d-flex flex-column align-items-start">
                  <h6 class="fs-6 fw-bold text-capitalize">{{ __("socials") }}</h6>
                  <ul class="d-flex flex-wrap ps-0 mb-0 list-group list-group-horizontal">
                    <li class="list-group-item p-1 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.facebook_url"><a target="_blank" class="text-dark"
                        :href="law_firm.law_firm_settings.facebook_url"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0" v-if="law_firm.law_firm_settings.youtube_url">
                      <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings.youtube_url"><i
                          class="bi bi-youtube"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0" v-if="law_firm.law_firm_settings.twitter_url">
                      <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings.twitter_url"><i
                          class="bi bi-twitter"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.linkedin_url"><a target="_blank" class="text-dark"
                        :href="law_firm.law_firm_settings.linkedin_url"><i class="bi bi-linkedin"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.whatsapp_url"><a target="_blank" class="text-dark"
                        :href="law_firm.law_firm_settings.whatsapp_url"><i class="bi bi-whatsapp"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.instagram_url"><a target="_blank" class="text-dark"
                        :href="law_firm.law_firm_settings.instagram_url"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0" v-if="law_firm.law_firm_settings.tiktok_url">
                      <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings.tiktok_url"><i
                          class="bi bi-tiktok"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.snapchat_url"><a target="_blank" class="text-dark"
                        :href="law_firm.law_firm_settings.snapchat_url"><i class="bi bi-snapchat"></i></a></li>
                    <li class="list-group-item p-1 bg-transparent border-0"
                      v-if="law_firm.law_firm_settings.pinterest_url"><a target="_blank" class="text-dark"
                        :href="law_firm.law_firm_settings.pinterest_url"><i class="bi bi-pinterest"></i></a></li>

                  </ul>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mx-0 pt-3 mt-3 g-0 appoint-buttons"
          v-if="law_firm.appointment_types ">
          <div class="col-lg-4 mb-3 pe-3" v-for="(schedule_type, index) in law_firm.appointment_types" :key="index">
            <div class="d-flex" @click="checkLoginAndRedirect(law_firm, schedule_type.appointment_type)" style="background-color: var(--tertiary-color) !important; border-radius:15px; cursor: pointer;">
              <div class="bg-secondary d-flex align-items-center justify-content-center" style="border-radius:15px;width: 50px;
                          ">
                <i class="bi text-white bi-camera-video-fill fs-5" v-if="schedule_type.type == 'video'"></i>
                <i class="bi text-white bi-telephone-fill fs-5" v-if="schedule_type.type == 'audio'"></i>
                <i class="bi text-white bi-chat-fill fs-5" v-if="schedule_type.type == 'chat'"></i>

              </div>
              <div class="p-2 text-start">
                <p class="fw-bold m-0" style="
                              font-size: 12px;"> {{ __(schedule_type.appointment_type.display_name) }}</p>
                <span style="
                                font-size: 11px;" class="">({{ getDisplayAmount(schedule_type.fee) }} <span
                    v-if="schedule_type.appointment_type.is_schedule_required">- {{
                      schedule_type.slot_duration }} {{ __("minutes") }}</span>)</span>
                <span role="button" style="font-size: 11px;" class="fw-bold ms-3"
                  >{{ getPageContent('general_book_btn_2_text') ??  __("Book Now")
                  }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link
  },
  props: ["law_firm", "add_col"],
  created() { },
  data() {
    return {};
  },
  methods: {
    checkLoginAndRedirect(law_firm, appointment_type) {
      if (this.$page.props.auth) {
        if (this.$page.props.auth.logged_in_as == 'customer') {
          this.$inertia.visit(route(
            'law_firm.book_appointment',
            {
              user_name: law_firm.user_name,
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
  }
});
</script>
