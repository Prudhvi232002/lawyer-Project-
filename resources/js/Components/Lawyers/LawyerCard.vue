<template>
  <div :class="{ 'col-md-3 col-lawyer': add_col, 'w-100': !add_col }">
    <div class="card lawyer-card item-h border-0 p-3 shadow-sm">
      <div class="card-body custom p-0">
        <div
          class="d-flex mb-3  d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
        >
          <img
            v-if="lawyer.image"
            class="img-fluid"
            :src="lawyer.image"
            alt="lawyer"
          />
          <img
            v-if="!lawyer.image"
            class="img-fluid m-3"
            src="@/images/account/default_avatar_men.png"
            alt="lawyer"
          />
          <div class="item-overlay top"></div>
          <div class="block--text text-center">
            <Link
              v-if="lawyer.user_name"
              :href="route('lawyer.profile', { user_name: lawyer.user_name })"
              class="btn btn-primary"
              >{{ getPageContent('general_book_btn_1_text') ?? __("view details") }}</Link
            >
          </div>

          <div class="overlay overlay09"></div>
        </div>

        <h2
          class="fs-6 d-flex align-items-center justify-content-center text-capitalize mb-1"
        >
          <i
            v-if="lawyer.is_featured"
            class="bi bi-patch-check-fill fs-5 me-2 text-secondary"
          ></i>
          <Link
            class="text-decoration-none text-dark fixed-title text-start text-capitalize"
            :href="route('lawyer.profile', { user_name: lawyer.user_name })"
          >
            {{ lawyer.name }}
            <small v-if="lawyer.law_firm_name" class="text-muted"
              >({{ lawyer.law_firm_name }})</small
            >
          </Link>
          <!-- <span class="fw-bold small ps-1 ms-2" style="border-left:2px solid" v-if="lawyer.distance"> ( {{ formatDecimal(lawyer.distance) }} Km) Away</span> -->
        </h2>
        <div>
          <p class="text-center mb-0 small" v-if="lawyer.distance">
            ( {{ formatDecimal(lawyer.distance) }} {{__('km') }} ) {{__('away') }}
          </p>
          <p class="text-center mb-0 small" v-else>
          ( 0.00 ) {{__('km') }}  {{__('away') }}
          </p>
        </div>
        <!-- <p class="fs-6 text-center px-3 mb-2" v-for="(cat, index) in lawyer.lawyer_categories" :key="index">{{ cat.name }}</p> -->

        <div class="d-flex justify-content-center my-2">
          <Link
            :href="route('lawyer.profile', { user_name: lawyer.user_name })"
            class="btn btn-primary btn-sm"
          >
            {{
              getPageContent("general_book_btn_1_text") ??
              __("book appointment")
            }}
          </Link>
        </div>

        <div
          class="d-flex align-items-center justify-content-center mb-2"
          style="color: white"
        >
          <star-rating
            :rating="lawyer.rating"
            :star-size="16"
            :read-only="true"
            :increment="0.01"
            :show-rating="false"
          ></star-rating>
          <span class="text-dark small mt-1 ps-1">
            ({{ lawyer.rating }}/5)</span
          >
        </div>

        <div class="d-flex align-items-center justify-content-center">
          <span
            v-if="lawyer.is_online"
            class="d-flex text-primary"
            style="font-size: 14px"
          >
            <i class="bi bi-circle-fill"></i>
            <span class="ms-1">{{
              getPageContent("general_online_text") ?? "Online"
            }}</span>
          </span>
          <span v-else class="d-flex text-muted" style="font-size: 14px">
            <i class="bi bi-circle-fill"></i>
            <span class="ms-1">{{
              getPageContent("general_offline_text") ?? "Offline"
            }}</span>
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
  props: ["lawyer", "add_col"],
  created() {},
  data() {
    return {};
  },
  methods: {},
});
</script>
