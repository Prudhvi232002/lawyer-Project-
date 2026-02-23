<template>
  <div :class="{ 'col-md-4': add_col, 'col-md-6': !add_col }">
    <div
      class="card item-h card-alt overflow-hidden border-0 shadow-sm rounded-md mb-4"
    >
      <div
        class="d-flex justify-content-center overflow-hidden card-avatar position-relative"
        style="height: 300px"
      >
        <!-- //for dynamic -->

        <img
          v-if="post.image"
          class="img-fluid w-100 rounded-md"
          :src="post.image"
          alt="image"
        />
        <img
          v-else
          class="img-fluid"
          src="@/images/common/image.png"
          alt="image"
        />
        <div class="item-overlay top"></div>
        <div
          class="icon mx-3 position-absolute end-0 bottom-0 block--text text-center"
        >
          <Link
            :href="route('blogs.detail', { slug: post.slug })"
            class="btn btn-primary"
            > {{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }} </Link
          >
        </div>
      </div>
      <div class="card-body">
        <h5 class="fixed-title mb-0">
          <a
            class="text-decoration-none text-dark"
            :href="route('blogs.detail', { slug: post.slug })"
            >{{ post.name }}</a
          >
        </h5>
        <span v-if="post.lawyer_id" class="badge bg-secondary">Lawyer</span>
        <span v-else-if="post.law_firm_id" class="badge bg-secondary"
          >LawFirm</span
        >
        <span v-else class="badge bg-secondary">Admin</span>
        <p class="mb-0 mt-3 lineclamp-2" v-html="post.description"></p>
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
    background_color: {},
    add_col: {
      default: true,
    },
    post: {},
  },
  created() {},
  data() {
    return {};
  },
  methods: {},
});
</script>
