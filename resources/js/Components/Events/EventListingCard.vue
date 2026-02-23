<template>
  <div
    class="w-100 item border-dark border-bottom px-3 mt-4"
    :class="{ item: add_col }"
  >
    <div class="card spotlight-card item-h bg-transparent border-0">
      <div class="card-body p-0">
        <div class="row p-3">
          <div class="col-lg-3 col-md-12">
            <div
              class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
              style="height: 205px"
            >
              <img
                v-if="event.image"
                class="img-fluid"
                :src="event.image"
                alt="event"
              />
              <img
                v-if="!event.image"
                class="img-fluid m-3"
                src="@/images/account/default_avatar_men.png"
                alt="event"
              />
            </div>
          </div>
          <div class="col-lg-9 col-md-12">
            <div
              class="card rounded-2xxl border-0 bg-transparent mb-4"
              style="border-radius: 20px"
            >
              <div class="card-body p-0">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                  <div class="d-flex flex-column align-items-start">
                    <h2 class="mb-0 fs-6 text-capitalize">
                      {{ event.name }}
                    </h2>
                    <span v-if="event.lawyer_id" class="badge bg-primary m-2">{{__('lawyer')}}</span>
                    <span v-else-if="event.law_firm_id" class="badge bg-primary m-2">{{__('law_firm')}}</span>
                    <span v-else class="badge bg-primary m-2">{{__('admin')}}</span>

                  </div>
                  <div class="d-flex align-items-center mt-2 mt-sm-0">
                    <Link
                      :href="route('events.detail', { slug: event.slug })"
                      class="btn btn-primary"
                      >   {{ getPageContent('general_book_btn_1_text') ?? __("view details") }} </Link
                    >
                  </div>
                </div>
              </div>
            </div>

            <div class="text-start">
              <p
                class=""
                v-if="event.description && event.description.length > 0"
              >
                {{ event.description.substring(0, 400) + "..." }}
              </p>
              <p class="" v-else>{{ event.description }}</p>
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
  props: ["event", "add_col"],
  created() {},
  data() {
    return {};
  },
  methods: {},
});
</script>
