<template>
  <div>
    <div class="col-12 text-center mb-3" v-if="appointments.data.length == 0">
      <record-not-found></record-not-found>
    </div>
    <div
      class="col-12 mb-3"
      v-for="appointment in appointments.data"
      :key="appointment.id"
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
                 v-if="appointment.customer_image"
                  class="img-fluid"
                  :src="appointment.customer_image"
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
                        {{ appointment.customer_name }}
                      </h2>

                      <div style="font-size: 14px" class="text-start me-5">
                        <p>
                            {{ __("appointment") }} # {{ appointment.id }}
                        </p>
                      </div>
                      <div style="font-size: 14px" class="text-start me-5">
                        <p>
                          {{ appointment.question }}
                        </p>
                      </div>
                    </div>

                    <div class="col-lg-4 text-end">
                      <Link
                        :href="
                          route('lawyer.appointment_log.detail', {
                            id: appointment.id,
                          })
                        "
                        class="btn btn-primary fw-bold shadow-sm mb-3 rounded w-100"
                      >
                        {{ __("view details") }}
                      </Link>
                      <div v-if="appointment.appointment_status_code == 5">
                        <button v-if="isShowRateBtn(appointment)"
                            data-bs-toggle="modal"
                            data-bs-target="#ratingModel"
                            id="rate_now_button"
                            @click="setAppointment(appointment)"
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
                          @click="submit(appointment)"
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
                    <span class="">{{ appointment.date }}</span>
                  </div>
                  <div
                    class="d-flex align-items-center me-3"
                    v-if="appointment.is_schedule_required"
                  >
                    <i class="bi bi-clock-fill me-3 fs-4 text-primary"></i>
                    <span class=""
                      >{{ appointment.start_time }} -
                      {{ appointment.end_time }}</span
                    >
                  </div>
                  <div class="d-flex align-items-center me-3" v-else>
                    <i class="bi bi-clock-fill me-3 fs-4 text-primary"></i>
                    <span class="">{{ __("available") }}</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                  <i class="bi bi-camera-video-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'video'"></i>
                  <i class="bi bi-telephone-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'audio'"></i>
                  <i class="bi bi-chat-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'chat'"></i>
                  <span class="me-3">{{
                    appointment.appointment_type_name
                  }}</span>
                  <span class="fw-bold">{{
                    appointment.is_paid ? __("paid") : __("un Paid")
                  }}</span>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                    <i class="bi bi-coin me-2 fs-4 text-primary"></i>
                  <span class="me-3">{{ __("fee") }}</span>
                  <span> {{ getDisplayAmount(appointment.fee)}}</span>
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
import RecordNotFound from "../../Shared/RecordNotFound.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    RecordNotFound,
  },
  props: ["appointments"],
  data() {
    return {
        form: this.$inertia.form({
        comment: "",
        rating: 0,
        lawyer_id: null,
        booked_appointment_id: null,
      }),
      showRatingObj :[],
    };
  },
  methods: {
    setAppointment(appointment){
        this.form.booked_appointment_id = appointment.id
        this.form.lawyer_id = appointment.lawyer_id
    },
    close() {
      document.getElementById("close").click();
    },
    resetForm() {
      this.form = this.$inertia.form({
        comment: "",
        rating: 0,
        lawyer_id: null,
        booked_appointment_id: null,
      });
    },
    checkUserAlreadyRated(appointment) {
      var variable = appointment.ratings.find(
        (rating) =>
          rating.fromable_type == this.$page.props.auth.logged_in_as &&
          rating.fromable_id ==
            this.$page.props.auth.user[this.$page.props.auth.logged_in_as].id
      );
      return variable ? false : true;
    },
    isShowRateBtn(appointment){
        var variable = this.showRatingObj.find(
        (rating) =>
          rating.appointment_id == appointment.id
      );
      return variable ? variable.isShow : false
    },
    setRating(rating) {
      this.form.rating = rating;
    },
    submit() {
      this.form.post(this.route("add_appointment_rating"), {
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
                rating.appointment_id === this.form.booked_appointment_id
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
    for (let index = 0; index < this.appointments.data.length; index++) {
        const element = this.appointments.data[index];
        var y = {
            'appointment_id' : element.id,
            'isShow' : this.checkUserAlreadyRated(element)
        }
        this.showRatingObj.push(y);
    }
},
});
</script>

<style>
</style>
