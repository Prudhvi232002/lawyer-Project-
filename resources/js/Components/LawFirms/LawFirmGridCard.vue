<template>
  <div :class="{ 'col-md-3 col-law_firm': add_col, 'w-100': !add_col }">
    <div class="card law_firm-card item-h border-0 py-3" style="min-height:342px">

      <div class="card-body p-0">
        <div class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative">
          <div class="position-absolute d-flex flex-column end-0">
            <button type="button"
                class="btn btn-primary me-2 mt-2" v-for="(schedule_type,index) in law_firm.appointment_types" :key="index" @click="checkLoginAndRedirect(law_firm,schedule_type.appointment_type)">
                    <span class="bi bi-camera-video-fill small" v-if="schedule_type.type == 'video'"></span>
                    <span class="bi bi-telephone-fill small" v-if="schedule_type.type == 'audio'"></span>
                    <span class="bi bi-chat-fill small" v-if="schedule_type.type == 'chat'"></span>
                </button> <br>
          </div>

          <img v-if="law_firm.image" class="img-fluid" :src="law_firm.image" alt="law_firm">
          <img v-if="!law_firm.image" class="img-fluid m-3" src="@/images/account/default_avatar_men.png" alt="law_firm">

        </div>
        <!-- <h6 class="text-center mb-2">{{ law_firm.name }} </h6> -->
        <h2 class="fs-6 d-flex align-items-center justify-content-center text-capitalize mb-1">
          <i v-if="law_firm.is_featured" class="bi bi-patch-check-fill fs-5 me-2 text-secondary"></i>
          <Link class="text-decoration-none text-dark" :href="route('law_firm.profile', { user_name: law_firm.user_name, })">
          {{
            law_firm.name }}</Link>
          <!-- <span class="fw-bold small ps-1 ms-2" style="border-left:2px solid" v-if="law_firm.distance"> ( {{ formatDecimal(law_firm.distance) }} Km) Away</span> -->
        </h2>
        <div>
          <p class="text-center mb-0 small" v-if="law_firm.distance">
            ( {{ formatDecimal(law_firm.distance) }} {{__('km') }} ) {{__('away') }}

          </p>
          <p class="text-center mb-0 small" v-else>

          </p>
        </div>
        <!-- <p class="fs-6 text-center px-3 mb-2" v-for="(cat, index) in law_firm.law_firm_categories" :key="index">{{ cat.name }}</p> -->

        <div class="d-flex justify-content-center my-2">

          <Link :href="route('law_firm.profile', { user_name: law_firm.user_name, })" class="btn btn-primary btn-sm">
            {{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}
          </Link>
        </div>

        <div class="d-flex align-items-center justify-content-center mb-2" style="color: white;">
          <star-rating :rating="law_firm.rating" :star-size="16" :read-only="true" :increment="0.01"
            :show-rating="false"></star-rating>
          <span class="text-dark small mt-1 ps-1"> ({{
            law_firm.rating
          }}/5)</span>
        </div>

        <div class="d-flex align-items-center justify-content-center">
          <span v-if="law_firm.is_online" class="d-flex text-primary" style="font-size: 14px;">
                            <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_online_text') ?? 'Online' }}</span>
                           </span>
          <span v-else class="d-flex text-muted" style="font-size: 14px;">
            <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_offline_text') ?? 'Offline' }}</span>
          </span>
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
  props: ['law_firm', 'add_col'],
  created() {
  },
  data() {
    return {
    };
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
  },
});
</script>
