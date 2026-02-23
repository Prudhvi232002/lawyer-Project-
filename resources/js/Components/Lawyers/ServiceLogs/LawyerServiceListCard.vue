<template>
  <div>
    <div class="col-12 text-center mb-3" v-if="services.data.length == 0">
      <record-not-found></record-not-found>
    </div>
    <div
      class="col-12 mb-3"
      v-for="service in services.data"
      :key="service.id"
    >
      <div class="card spotlight-card shadow-sm p-4 item-h border-0">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-3">
              <div
                class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                style="height: 150px"
              >
              <img
                 v-if="service.customer_image"
                  class="img-fluid"
                  :src="service.customer_image"
                  alt="lawyer"
                />
                <img
                v-else
                  class="img-fluid"
                  src="@/images/account/default_avatar_men.png"
                  alt="lawyer"
                />
              </div>
            </div>
            <div class="col-lg-9">
              <div>
                <div class="card-body p-0">
                  <div class="row">
                    <div class="col-lg-8">
                      <h2 class="mb-3 fs-6 text-capitalize">
                        {{ service.customer_name }}
                      </h2>

                      <div style="font-size: 14px" class="text-start me-5">
                        <p>
                            {{ __("service") }} # {{ service.id }}
                        </p>
                      </div>
                      <div style="font-size: 14px" class="text-start me-5">
                        <p>
                          {{ service.question }}
                        </p>
                      </div>
                    </div>

                    <div class="col-lg-4 text-end">
                      <Link
                        :href="
                          route('lawyer.service_log.detail', {
                            id: service.id,
                          })
                        "
                        class="btn btn-primary fw-bold shadow-sm mb-3 rounded w-100"
                      >
                        {{ __("view details") }}
                      </Link>
                      <div v-if="service.service_status_code == 5">
                        <button v-if="isShowRateBtn(service)"
                            data-bs-toggle="modal"
                            data-bs-target="#ratingModel"
                            id="rate_now_button"
                            @click="setService(service)"
                        class="btn btn-primary fw-bold shadow-sm mb-3 rounded w-100"
                      >
                        Rate Us
                      </button>
                      <button v-else
                        class="btn btn-success fw-bold shadow-sm mb-3 rounded w-100"
                      >
                        Rated
                      </button>
                      </div>

                      <div
                  class="modal fade"
                  id="ratingModel"
                  tabindex="-1"
                  aria-labelledby="ratingModelLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ratingModelLabel">
                            {{ __("rate now") }}
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <label for="rating">{{ __("rating") }}:</label>
                        <div class="rating text-center fs-3 text-warning">
                          <star-rating
                            v-model="form.rating"
                            @update:rating="setRating"
                            :star-size="25"
                          ></star-rating>
                        </div>
                        <div class="form-group">
                          <label for="comment">{{ __("comment") }}:</label>
                          <textarea
                            v-model="form.comment"
                            class="form-control"
                            id=""
                            cols="30"
                            rows="3"
                          ></textarea>
                          <span v-if="form.errors.comment">
                            {{ form.errors.comment }}
                          </span>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          id="close"
                          data-bs-dismiss="modal"
                        >
                          {{ __("close") }}
                        </button>
                        <button
                          type="button"
                          @click="submit(service)"
                          class="btn btn-primary"
                        >
                          {{ __("submit") }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                      <!-- <button class="btn btn-primary">
                                            {{ __("rescedule") }}
                                        </button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0 py-3 bg-primary-light rounded-lg">
              <div class="col-lg-5">
                <div class="d-md-flex align-items-center">
                  <div class="d-flex align-items-center me-3">
                    <i class="bi bi-calendar3 me-3 fs-4 text-primary"></i>
                    <span class="">{{ service.date }}</span>
                  </div>
                  <div class="d-flex align-items-center me-3">
                    <i class="bi bi-clock-fill me-3 fs-4 text-primary"></i>
                    <span class="">{{ __("available") }}</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                  <i class="bi bi-camera-video-fill me-2 fs-4 text-primary" v-if="service.service_type == 'video'"></i>
                  <i class="bi bi-telephone-fill me-2 fs-4 text-primary" v-if="service.service_type == 'audio'"></i>
                  <i class="bi bi-chat-fill me-2 fs-4 text-primary" v-if="service.service_type == 'chat'"></i>
                  <span class="me-3">{{
                    service.service_type_name
                  }}</span>
                  <span class="fw-bold">{{
                    service.is_paid ? __("paid") : __("un Paid")
                  }}</span>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                    <i class="bi bi-coin me-2 fs-4 text-primary"></i>
                  <span class="me-3">{{ __("fee") }}</span>
                  <span> {{ getDisplayAmount(service.price)}}</span>
                </div>
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
import { Head, Link } from "@inertiajs/inertia-vue3";
import RecordNotFound from "@/Components/Shared/RecordNotFound.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    RecordNotFound,
  },
  props: ["services"],
  data() {
    return {
        form: this.$inertia.form({
        comment: "",
        rating: 0,
        lawyer_id: null,
        booked_service_id: null,
      }),
      showRatingObj :[],
    };
  },
  methods: {
    setService(service){
        this.form.booked_service_id = service.id
        this.form.lawyer_id = service.lawyer_id
    },
    close() {
      document.getElementById("close").click();
    },
    resetForm() {
      this.form = this.$inertia.form({
        comment: "",
        rating: 0,
        lawyer_id: null,
        booked_service_id: null,
      });
    },
    checkUserAlreadyRated(service) {
      var variable = service.reviews.find(
        (rating) =>
          rating.fromable_type == this.$page.props.auth.logged_in_as &&
          rating.fromable_id ==
            this.$page.props.auth.user[this.$page.props.auth.logged_in_as].id
      );
      return variable ? false : true;
    },
    isShowRateBtn(service){
        var variable = this.showRatingObj.find(
        (rating) =>
          rating.service_id == service.id
      );
      return variable ? variable.isShow : false
    },
    setRating(rating) {
      this.form.rating = rating;
    },
    submit() {
      this.form.post(this.route("add_service_rating"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          const modalBackdrop = document.querySelector(".modal-backdrop");
          if (modalBackdrop) {
            modalBackdrop.classList.remove("modal-backdrop");

          }
          this.close();
          var index = this.showRatingObj.findIndex(
                (rating) =>
                rating.service_id === this.form.booked_service_id
            );
            if(index >= 0){
                this.showRatingObj[index].isShow = false
            }
            this.resetForm();
        },
      });
    },
  },
  mounted() {
    for (let index = 0; index < this.services.data.length; index++) {
        const element = this.services.data[index];
        var y = {
            'service_id' : element.id,
            'isShow' : this.checkUserAlreadyRated(element)
        }
        this.showRatingObj.push(y);
    }
},
});
</script>

<style>
</style>
