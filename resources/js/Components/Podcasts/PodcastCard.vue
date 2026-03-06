<template>
  <div :class="{ 'col-md-3': add_col, 'col-md-6': !add_col }">
    <div
      class="card item-h card-alt overflow-hidden border-0 rounded-ms shadow-sm mb-4"
    >
      <div
        class="d-flex justify-content-center overflow-hidden card-avatar rounded-2 position-relative"
        style="height: 250px"
      >
        <img
          v-if="podcast.image"
          class="img-fluid"
          :src="podcast.image"
          alt="image"
        />
        <img
          v-else
          class="img-fluid m-3"
          src="@/images/common/podcast.png"
          alt="image"
        />
        <div class="item-overlay top"></div>
        <!-- <div class="block--text text-center">
          <Link
            :href="route('podcasts.detail', { slug: podcasts.slug })" class="btn btn-primary"
            >{{ __("view detail") }}</Link
          >
        </div> -->
        <div class="icon mx-3 position-absolute end-0 bottom-0 block--text text-center">
          <Link :href="route('podcasts.detail', { slug: podcast.slug })" class="btn btn-primary">{{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}</Link>
        </div>
      </div>
      <div class="card-body">
        <h5 class="fixed-title mb-0">
          <a
            class="text-decoration-none text-dark"
            :href="route('podcasts.detail', { slug: podcast.slug })"
            >{{ podcast.name }}</a
          >
        </h5>
        <span v-if="podcast.lawyer_id" class="badge bg-secondary">Lawyer</span>
        <span v-else-if="podcast.law_firm_id" class="badge bg-secondary"
          >LawFirm</span
        >
        <span v-else class="badge bg-secondary">Admin</span>
        <p class="mb-0 mt-3 lineclamp-2" v-html="podcast.description"></p>
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
  props: {
    podcast: {},
    add_col: {
      default: true,
    },
  },
  created() {
  },
  data() {
    return {};
  },
  methods: {},
});
</script>
