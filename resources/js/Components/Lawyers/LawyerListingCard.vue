<template>
  <div class="w-100 listView" :class="{ 'item': add_col }">
    <div class="card spotlight-card item-h border-0 p-3" :class="{ 'bg-transparent shadow-none': list_card }">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-3 position-relative">

            <Link class="text-decoration-none" :href="route('lawyer.profile', { user_name: lawyer.user_name })">
            <div class="d-flex justify-content-center card-avatar overflow-hidden position-relative"
              style="height: 205px">
              <img v-if="lawyer.image" class="img-fluid" :src="lawyer.image" alt="lawyer" />
              <img v-if="!lawyer.image" class="img-fluid" src="@/images/account/default_avatar_men.png" alt="lawyer" />
            </div>
            </Link>

            <div class="d-flex align-items-center justify-content-center mt-1">

              <star-rating :rating="lawyer.rating" :star-size="16" :read-only="true" :increment="0.01"
                :show-rating="false"></star-rating>
              <span class="text-dark small mt-1 ps-1">({{ lawyer.rating }}/5)</span>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-2">
              <span v-if="lawyer.is_online" class="d-flex text-primary" style="font-size: 14px;">
                      <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_online_text') ??  'Online'}} </span>
                </span>
              <span v-else class="d-flex text-muted" style="font-size: 14px;">
                <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_offline_text') ??  'Offline'}} </span>
              </span>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="d-md-flex align-items-center justify-content-between mb-3">
              <div class="d-flex custom mb-md-0 mb-3 align-items-start justify-content-center justify-content-lg-start">
                <h2 class="mb-0 fs-6 text-dark d-flex align-items-center text-capitalize">
                  <i v-if="lawyer.is_featured" class="bi bi-patch-check-fill fs-5 me-2 text-secondary"></i>
                  <Link class="text-decoration-none text-dark"
                    :href="route('lawyer.profile', { user_name: lawyer.user_name, })">{{ lawyer.name }} <small v-if="lawyer.law_firm_name" class="text-muted">({{ lawyer.law_firm_name }})</small>

                  </Link>
                  <span class="fw-normal small ps-1 ms-2" style="border-left:2px solid" v-if="lawyer.distance"> ( {{
                    formatDecimal(lawyer.distance) }} {{ __('km') }}) {{ __('away') }}</span>
                </h2>

              </div>
              <div class="d-md-flex d-grid align-items-center">

                <Link :href="route('lawyer.profile', { user_name: lawyer.user_name, })" class="btn btn-primary btn-sm">
                {{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}
                </Link>
              </div>
            </div>
            <div class="mb-3 text-start" v-if="lawyer.lawyer_categories && lawyer.lawyer_categories.length > 0">
              <ul class="list-unstyled mb-0">
                <li class="me-2 d-inline-block pe-2" style="font-size: 12px" v-for="(cat, i) in lawyer.lawyer_categories"
                  :key="cat.id" v-bind:class="{ 'border-end': i != lawyer.lawyer_categories.length - 1 }">
                  {{ cat.name }}
                </li>
              </ul>
            </div>
            <div style="font-size: 14px" v-html="lawyer.description" class="text-start desc mb-3"></div>

            <div class="row">
              <div class="col-md-3 text-start" v-if="lawyer.experience">
                <h6 class="fs-6 fw-bold text-capitalize">{{ __("experience") }}</h6>
                <p class="mb-0" v-if="lawyer.experience == 1">{{ lawyer.experience }} {{ __("year") }}</p>
                <p class="mb-0" v-else>{{ lawyer.experience }} {{ __("years") }}</p>
              </div>

              <div class="col-md-3 text-start" v-if="lawyer.speciality">
                <h6 class="fs-6 fw-bold text-capitalize">{{ __("speciality") }}</h6>
                <p class="mb-0">{{ lawyer.speciality }}</p>
              </div>

              <div class="col-md-6 text-start" v-if="checkObjectValuesIsNotNull(lawyer.lawyer_settings)">
                <div class="d-flex flex-column align-items-start">
                  <h6 class="fs-6 fw-bold text-capitalize">{{ __("socials") }}</h6>
                  <ul class="d-flex flex-wrap justify-content-end ps-0 mb-0 list-group list-group-horizontal">
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.facebook_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .facebook_url
                        "><i class="bi bi-facebook"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0  bg-transparent border-0" v-if="lawyer.lawyer_settings.youtube_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .youtube_url
                        "><i class="bi bi-youtube"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.twitter_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .twitter_url
                        "><i class="bi bi-twitter"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.linkedin_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .linkedin_url
                        "><i class="bi bi-linkedin"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.whatsapp_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .whatsapp_url
                        "><i class="bi bi-whatsapp"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.instagram_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .instagram_url
                        "><i class="bi bi-instagram"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.tiktok_url">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .tiktok_url
                        "><i class="bi bi-tiktok"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.snapchat_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .snapchat_url
                        "><i class="bi bi-snapchat"></i></a>
                    </li>
                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="lawyer.lawyer_settings.pinterest_url
                      ">
                      <a target="_blank" class="text-dark" :href="lawyer.lawyer_settings
                        .pinterest_url
                        "><i class="bi bi-pinterest"></i></a>
                    </li>
                  </ul>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mx-0 pt-3 mt-3 g-0 appoint-buttons"
          v-if="lawyer.appointment_types ">
          <div class="col-lg-4 mb-3 pe-3" v-for="(schedule_type, index) in lawyer.appointment_types" :key="index">
            <div class="d-flex" @click="checkLoginAndRedirect(lawyer, schedule_type.appointment_type)" style="background-color: var(--tertiary-color) !important; border-radius:15px; cursor: pointer;">
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
                                font-size: 11px;" class="">({{  getDisplayAmount(schedule_type.fee) }} <span
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
    Link,
  },
  props: ['lawyer', 'add_col'],
  created() {

  },
  data() {
    return {
    };
  },
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
  },
});
</script>
