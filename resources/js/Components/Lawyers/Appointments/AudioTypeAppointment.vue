<template>
  <div v-if="fetching">
    <time-slots-skeleton></time-slots-skeleton>
  </div>
  <div v-else>
    <div v-if="schedules.length == 0">
      <form @submit.prevent="submit" class="profileForm">
        <div class="row">
          <div class="col-md-12">
            <validation-errors></validation-errors>
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <div class="row p-4 bg-primary bg-opacity-10 rounded-5 mx-0">
                    <div class="form-group mb-4">
                      <label for="category"
                        >{{ __("select") }} {{ __("days") }}</label
                      >
                      <Multiselect
                        v-model="form.selected_days"
                        valueProp="value"
                        label="name"
                        mode="tags"
                        :close-on-select="false"
                        :searchable="true"
                        :options="this.weak_days"
                      />
                    </div>

                    <div class="col-md-4 mb-3">
                      <div class="ps-0">
                        <label for="start_time">{{ __("start time") }}</label>
                        <input
                          v-model="form.start_time"
                          class="w-100 form-control border- px-3"
                          placeholder="Please Enter"
                          type="time"
                          v-on:input="enableButton()"
                        />
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <div class="ps-0">
                        <label for="end_time">{{ __("end time") }}</label>
                        <input
                          v-model="form.end_time"
                          class="w-100 form-control px-3"
                          placeholder="Please Enter"
                          type="time"
                          v-on:input="enableButton()"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="ps-0">
                        <label for="interval">{{ __("interval") }}</label>
                        <input
                          v-model="form.interval"
                          class="w-100 form-control px-3"
                          placeholder="Please Enter"
                          type="integer"
                          v-on:input="enableButton()"
                        />
                      </div>

                  </div>
                  <div class="col-md-4">
                      <div class="ps-0">
                        <label for="fee">{{ __("fee") }}</label>
                        <div class="input-group d-flex align-items-center mb-3">
                            <span class="input-group-text p-2" id="basic-addon1">{{getDefaultCurrencySymbol()}}</span>
                            <input
                            v-model="form.fee"
                            class="form-control px-3"
                            placeholder="Please Enter"
                            type="text"
                            v-on:input="enableButton()"
                            v-on:keypress="inputNumbersOnly()"
                            v-bind:on-keypress="updateFeeCommission()"
                            />

                            <span class="ps-3"  v-if="isCommissionEnabled()">+</span>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-4"  v-if="isCommissionEnabled()">
                        <label for="commission">{{ __("commission") }}</label>
                        <div class="input-group d-flex align-items-center mb-3">
                            <input
                            class="form-control px-3"
                            :placeholder="commission && (commission.commission_type == 'fixed_rate' ? getDefaultCurrencySymbol() + commission.rate : commission.rate+'%')"
                            type="text"
                            disabled
                            />
                            <span class="ps-3">=</span>
                        </div>
                    </div>
                    <div class="col-md-4"  v-if="isCommissionEnabled()">
                        <label for="total">{{ __("total") }}</label>
                        <div class="input-group d-flex align-items-center mb-3">
                            <input
                            class="form-control px-3"
                            :placeholder="getDisplayAmount(feeAfterCommission)"
                            type="text"
                            disabled
                            />

                        </div>
                    </div>
                    <div class="col-12">
                        <p v-if="isCommissionEnabled()"><b>Note:</b>
                            The administrative has determined that the commission for legal services is <span v-if="commission && commission.commission_type == 'fixed_rate'">{{ getDefaultCurrencySymbol() }} {{ commission.rate }}</span> <span v-if="commission && commission.commission_type == 'percentage'"> {{ commission.rate }}%</span> of the final amount, which is equivalent to {{ getDisplayAmount(feeAfterCommission) }}.
                            </p>

                    </div>
                    </div>
                  <button
                    type="button"
                    @click="generateTimeSlots"
                    class="submit w-100 mt-4 btn btn-primary py-2"
                    :disabled="disableButton"
                  >
                    {{ __("generate slots") }}
                  </button>
                </div>
                <div class="col-12 cat-card time-list mt-4">
                    <div v-if="Object.keys(form.generated_slots).length > 0">
                        <div class="d-flex align-items-center justify-content-between pb-2 mb-4 border-bottom border-primary">
                            <div>
                                <span class="fw-bold">You have successfully generated slots</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="fw-bold me-2">{{ __("interval") }}:</span> <span>
                                        {{ form.interval }} min
                                    </span>
                                </div>

                                <div>
                                    <span class="fw-bold me-2">Fee:</span>
                                     <span v-if="isCommissionEnabled()">
                                         {{ getDisplayAmount(feeAfterCommission) }}
                                    </span>
                                    <span v-else>
                                         {{ getDisplayAmount(form.fee) }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    <div class="accordion border-0 p-0" id="accordionExample">
                      <div
                        class="accordion-item border shadow-sm rounded-md mb-4"
                        v-for="(day, dayIndex) in weak_days"
                        :key="dayIndex"
                      >
                        <div
                          class="accordion-header rounded-md shadow-none d-flex align-items-center justify-content-between w-100 py-2 px-3"
                          style="background-color: var(--tertiary-color)"
                          :id="'headingOne' + dayIndex"
                        >
                          <div
                            class="accordion-button bg-transparent shadow-none p-1 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            :data-bs-target="'#collapseOne' + dayIndex"
                            aria-expanded="true"
                            :aria-controls="'collapseOne' + dayIndex"
                          >
                            <div class=" ">
                              <div class="fs-5 fw-bold mb-0 ms-4">
                                {{ day.name }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          :id="'collapseOne' + dayIndex"
                          class="accordion-collapse collapse show"
                          :aria-labelledby="'headingOne' + dayIndex"

                        >
                          <div
                            class="accordion-body p-2 time-slots-list"
                            v-if="Object.keys(form.generated_slots).length > 0"
                          >
                            <div
                              v-if="form.generated_slots[day.value]"
                              class="position-relative"
                            >
                              <ul class="list-unstyled d-flex flex-wrap">
                                <li
                                  class="mb-2 p-2 m-1 rounded-5 border border-primary"
                                  v-for="(slot, index) in form.generated_slots[
                                    day.value
                                  ]"
                                  :key="index"
                                  :class="
                                    slot.is_active
                                      ? ''
                                      : 'bg-light text-muted border-light'
                                  "
                                  @click="changeSlotStatus(index, day.value)"
                                >
                                  <span
                                    >{{ slot.start_time }}
                                    <i
                                      class="bi bi-arrow-left-right text-primary"
                                      :class="
                                        slot.is_active ? '' : 'text-muted'
                                      "
                                    ></i>
                                    {{ slot.end_time }}</span
                                  >
                                </li>
                              </ul>
                            </div>

                            <div
                              class="position-relative py-5 d-flex align-items-center justify-content-center h-100"
                              v-else
                            >
                              <h3>
                                <i
                                  class="bi bi-x-octagon-fill fs-2 text-primary"
                                ></i>
                                {{ __("holiday") }}
                              </h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <div
                class="row align-items-center"
                v-if="Object.keys(form.generated_slots).length > 0"
              >
                <div class="col-12 text-center">
                  <button
                    type="submit"
                    :disabled="form.processing"
                    class="submit btn btn-primary"
                  >
                    {{ __("save") }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div v-else>
      <div class="row mt-4 mx-0 bg-white cat-card time-list rounded-5">
        <div class="d-flex align-items-center justify-content-between pb-2 mb-4 border-bottom border-primary">
                    <div>
                        <span class="fw-bold">Your generated slots</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="fw-bold me-2">{{ __("interval") }}:</span> <span>
                                {{ generatedSceduleInterval}} min
                            </span>
                        </div>

                        <div>
                            <span class="fw-bold me-2">Fee:</span> <span>
                                {{ getDisplayAmount(generatedSceduleFee) }}
                            </span>
                        </div>

                    </div>
        </div>
        <div class="accordion border-0 p-0" id="accordionExample">
          <div
            class="accordion-item border shadow-sm rounded-md mb-4"
            v-for="(day, dayIndex) in weak_days"
            :key="dayIndex"
          >
            <div
              class="accordion-header rounded-md shadow-none d-flex align-items-center justify-content-between w-100 py-2 px-3"
              style="background-color: var(--tertiary-color)"
              :id="'headingOne' + dayIndex"
            >
              <div
                class="accordion-button bg-transparent shadow-none p-1 collapsed"
                type="button"
                data-bs-toggle="collapse"
                :data-bs-target="'#collapseOne' + dayIndex"
                aria-expanded="true"
                :aria-controls="'collapseOne' + dayIndex"
              >
                <div class=" ">
                  <div class="fs-5 fw-bold mb-0 ms-4">{{ day.name }}</div>
                </div>
              </div>
              <button
                v-if="schedules[day.value]"
                type="button"
                class="btn btn-transparent p-0 border-0 text-danger fs-5"
                data-bs-toggle="modal"
                :data-bs-target="'#deleteScheduleModal_' + dayIndex"
              >
                <i class="bi bi-trash"></i>
              </button>
              <button
                v-else
                type="button"
                class="btn btn-secondary btn-sm"
                @click="() => (addForm.day = day.value)"
                data-bs-toggle="modal"
                :data-bs-target="'#addScheduleModal_' + dayIndex"
              >
                <!-- <i class="bi bi-plus fs-1 fw-bolder text-success pe-2"></i> -->
                {{ __("add") }}
              </button>
            </div>
            <div
              :id="'collapseOne' + dayIndex"
              class="accordion-collapse collapse show"
              :aria-labelledby="'headingOne' + dayIndex"

            >
              <div class="accordion-body p-2 position-relative time-slots-list">
                <div v-if="schedules[day.value]" class="position-relative">
                  <ul class="list-unstyled d-flex flex-wrap mb-0">
                    <li
                      class="mb-2 p-2 m-1 rounded-5 border border-primary"
                      v-for="(slot, index) in schedules[day.value]
                        .schedule_slots"
                      :key="index"
                    >
                      <span
                        >{{ slot.start_time }}
                        <i
                          class="bi bi-arrow-left-right text-primary"
                          :class="slot.is_active ? '' : 'text-muted'"
                        ></i>
                        {{ slot.end_time }}</span
                      >
                    </li>
                  </ul>
                </div>
                <div
                  class="py-2 d-flex align-items-center justify-content-center h-100"
                  v-else
                >
                  <h3 class="text-capitalize mb-0">
                    <i class="bi bi-x-lg fs-3 text-muted"></i>
                    {{ __("holiday") }}
                  </h3>
                </div>
              </div>
            </div>
            <!-- Delete Modal -->
            <div
              class="modal fade"
              :id="'deleteScheduleModal_' + dayIndex"
              tabindex="-1"
              aria-labelledby="deleteScheduleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <form
                  @submit.prevent="
                    deleteSelectDaySlots(
                      day.value,
                      'deleteScheduleModalClose_' + dayIndex
                    )
                  "
                >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteScheduleModalLabel">
                        {{ __("Alert Delete Model") }}
                      </h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      {{ __("Are you sure you want to delete schedule") }}
                    </div>
                    <div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        :id="'deleteScheduleModalClose_' + dayIndex"
                      >
                        {{ __("close") }}
                      </button>
                      <button
                        type="submit"
                        :disabled="deleteForm.processing"
                        class="btn btn-primary"
                      >
                        {{ __("yes") }}
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Add Modal -->
            <div
              class="modal fade"
              :id="'addScheduleModal_' + dayIndex"
              tabindex="-1"
              aria-labelledby="addSlotsModelLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-xl">
                <form
                  @submit.prevent="
                    addSelectDaySlots(
                      day.value,
                      'addScheduleModalClose_' + dayIndex
                    )
                  "
                >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        {{ __("Add Schedule Model") }}
                      </h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <validation-errors></validation-errors>
                      <div class="row px-3">
                        <div class="col-4">
                          <div class="">
                            <label for="start_time">{{
                              __("start time")
                            }}</label>
                            <input
                              v-model="addForm.start_time"
                              class="w-100 form-control border- px-3"
                              placeholder="Please Enter"
                              type="time"
                            />
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="">
                            <label for="end_time">{{ __("end time") }}</label>
                            <input
                              v-model="addForm.end_time"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="time"
                            />
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="">
                            <label for="interval">{{ __("interval") }}</label>
                            <input
                              v-model="addForm.interval"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="integer"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="row px-3">
                        <div class="col-12">
                          <button
                            type="button"
                            @click="generateTimeSlotsForAdd"
                            class="submit mt-4 btn btn-primary"
                          >
                            {{ __("generate slots") }}
                          </button>
                        </div>
                      </div>

                      <div v-if="addForm.generated_slots.length > 0">
                        <div class="row border shadow-sm mt-3 rounded-5 mx-3">
                          <div class="col-md-12 p-0">
                            <div
                              class="rounded-md shadow-none d-flex align-items-center justify-content-between w-100 py-2 px-3"
                              style="background-color: rgba(250, 193, 77, 0.23)"
                            >
                              <div class="bg-transparent shadow-none p-1">
                                <div class=" ">
                                  <div class="fs-5 fw-bold mb-0 ms-2">
                                    {{ addForm.day }}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="col-md-12 mt-3 time-slots-list"
                            v-if="addForm.generated_slots.length > 0"
                          >
                            <ul class="list-unstyled d-flex flex-wrap">
                              <li
                                class="mb-2 p-2 m-1 rounded-5 border border-primary"
                                v-for="(
                                  slot, slotIndex
                                ) in addForm.generated_slots"
                                :key="slotIndex"
                              >
                                <span
                                  >{{ slot.start_time }}
                                  <i
                                    class="bi bi-arrow-left-right text-primary"
                                    :class="slot.is_active ? '' : 'text-muted'"
                                  ></i>
                                  {{ slot.end_time }}</span
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        :id="'addScheduleModalClose_' + dayIndex"
                      >
                        {{ __("close") }}
                      </button>
                      <button
                        type="submit"
                        :disabled="addForm.processing"
                        class="btn btn-primary"
                      >
                        {{ __("submit") }}
                      </button>
                    </div>
                  </div>
                </form>
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
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Multiselect from "@vueform/multiselect";
import TimeSlotsSkeleton from "@/Components/Skeleton/TimeSlotsSkeleton.vue";
export default defineComponent({
  components: {
    Head,
    ValidationErrors,
    Link,
    Multiselect,
    TimeSlotsSkeleton,
  },
  props: ["appointment_type_id", "is_schedule_required", "appointment_type"],
  data() {
    return {
      weak_days: [
        {
          id: 1,
          name: "Sunday",
          value: "sunday",
          is_holiday: 1,
        },
        {
          id: 2,
          name: "Monday",
          value: "monday",
          is_holiday: 1,
        },
        {
          id: 3,
          name: "Tuesday",
          value: "tuesday",
          is_holiday: 1,
        },
        {
          id: 4,
          name: "Wednesday",
          value: "wednesday",
          is_holiday: 1,
        },
        {
          id: 5,
          name: "Thursday",
          value: "thursday",
          is_holiday: 1,
        },
        {
          id: 6,
          name: "Friday",
          value: "friday",
          is_holiday: 1,
        },
        {
          id: 6,
          name: "Saturday",
          value: "saturday",
          is_holiday: 1,
        },
      ],
      form: this.$inertia.form({
        appointment_type_id: this.appointment_type_id,
        is_schedule_required: this.is_schedule_required,
        appointment_type: this.appointment_type,
        selected_days: [
          "sunday",
          "monday",
          "tuesday",
          "wednesday",
          "thursday",
          "friday",
          "saturday",
        ],
        start_time: "",
        end_time: "",
        fee: "",
        interval: "",
        generated_slots: {},
      }),
      schedules: [],
      commission:null,
      feeAfterCommission:null,
      fetching: true,
      deleteForm: this.$inertia.form({
        day: "",
        appointment_type_id: this.appointment_type_id,
      }),
      addForm: this.$inertia.form({
        day: "",
        appointment_type_id: this.appointment_type_id,
        start_time: "",
        end_time: "",
        interval: "",
        generated_slots: {},
      }),
      disableButton: true,
      generatedSceduleInterval:"",
     generatedSceduleFee:""
    };
  },
  methods: {
    getAppointmentschedules() {
      this.fetching = true;
      axios
        .get(
          this.route("lawyer.getApiAppointmentSchedules", {
            appointment_type_id: this.form.appointment_type_id,
            is_schedule_required: this.form.is_schedule_required,
          })
        )
        .then((res) => {
          this.schedules = res.data.data;
          let index = 0
            for (const [key, value] of Object.entries(this.schedules)) {
                if (index == 0) {
                this.generatedSceduleInterval = value.slot_duration
                this.generatedSceduleFee = value.fee
                index++;
                }
            }
          this.fetching = false;
        });
    },
    getAppointmentCommission() {
      this.fetching = true;
      axios
        .get(
          this.route("lawyer.getApiAppointmentCommission", {
            appointment_type_id: this.form.appointment_type_id,
          })
        )
        .then((res) => {
          this.commission = res.data.data;
          this.fetching = false;
        });
    },
    enableButton() {
      if (
        this.form.start_time &&
        this.form.end_time &&
        this.form.fee &&
        this.form.interval
      ) {
        this.disableButton = false;
      } else {
        this.disableButton = true;
      }
    },
    generateTimeSlots() {
      if (!this.form.interval) {
        this.$toast.error("Interval is required.");
        return;
      }
      this.form.generated_slots = {};
      const slots = [];
      const start = new Date();
      const end = new Date();
      const startParts = this.form.start_time.split(":");
      const endParts = this.form.end_time.split(":");

      start.setHours(startParts[0]);
      start.setMinutes(startParts[1]);
      end.setHours(endParts[0]);
      end.setMinutes(endParts[1]);

      if (end.getTime() === start.getTime()) {
        this.$toast.error("Start time and end time cannot be equal.");
        return;
      }

      // Handle cases where end time is earlier than start time
      if (
        endParts[0] < startParts[0] ||
        (endParts[0] === startParts[0] && endParts[1] < startParts[1])
      ) {
        end.setDate(end.getDate() + 1); // Increment end date by 1 day
      }

      const intervalMs = (this.form.interval - 1) * 60000; // Convert interval to milliseconds

      let currentTime = start;

      while (currentTime < end) {
        currentTime.setTime(currentTime.getTime() + 60000);
        let startTime = currentTime.toLocaleTimeString([], {
          hour: "2-digit",
          minute: "2-digit",
        });
        let endTime =
          currentTime.setTime(currentTime.getTime() + intervalMs) <=
          end.getTime()
            ? currentTime.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              })
            : end.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              });
        let is_active = true;
        slots.push({
          start_time: startTime,
          end_time: endTime,
          is_active: is_active,
        });
      }
      this.form.selected_days.forEach((day) => {
        this.form.generated_slots[day] = slots;
      });
    },
    generateTimeSlotsForAdd() {
      if (!this.addForm.interval) {
        this.$toast.error("Interval is required.");
        return;
      }
      this.addForm.generated_slots = {};
      const slots = [];
      const start = new Date();
      const end = new Date();
      const startParts = this.addForm.start_time.split(":");
      const endParts = this.addForm.end_time.split(":");
      start.setHours(startParts[0]);
      start.setMinutes(startParts[1]);
      end.setHours(endParts[0]);
      end.setMinutes(endParts[1]);
      if (end.getTime() === start.getTime()) {
        this.$toast.error("Start time and end time cannot be equal.");
        return;
      }

      // Handle cases where end time is earlier than start time
      if (
        endParts[0] < startParts[0] ||
        (endParts[0] === startParts[0] && endParts[1] < startParts[1])
      ) {
        end.setDate(end.getDate() + 1); // Increment end date by 1 day
      }
      const intervalMs = (this.addForm.interval - 1) * 60000; // Convert interval to milliseconds
      let currentTime = start;
      while (currentTime < end) {
        currentTime.setTime(currentTime.getTime() + 60000);
        let startTime = currentTime.toLocaleTimeString([], {
          hour: "2-digit",
          minute: "2-digit",
        });
        let endTime =
          currentTime.setTime(currentTime.getTime() + intervalMs) <=
          end.getTime()
            ? currentTime.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              })
            : end.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              });
        let is_active = true;
        slots.push({
          start_time: startTime,
          end_time: endTime,
          is_active: is_active,
        });
      }
      this.addForm.generated_slots = slots;
    },
    changeSlotStatus(index, day) {
      this.form.generated_slots[day][index].is_active =
        !this.form.generated_slots[day][index].is_active;
    },
    submit() {
      this.form.post(this.route("lawyer.save_appointment_schedules"), {
        onSuccess: () => {
          this.getAppointmentschedules();
        },
      });
    },
    deleteSelectDaySlots(day_value, model_id) {
      this.deleteForm.day = day_value;
      this.deleteForm.post(this.route("lawyer.delete_appointment_slots"), {
        onSuccess: () => {
          document.getElementById(model_id).click();
          this.getAppointmentschedules();
        },
      });
    },
    addSelectDaySlots(day_value, model_id) {
      this.addForm.day = day_value;
      this.addForm.post(this.route("lawyer.add_new_appointment_schedules"), {
        onSuccess: () => {
          document.getElementById(model_id).click();
          this.addForm.day = "";
          this.addForm.start_time = "";
          this.addForm.end_time = "";
          this.addForm.interval = "";
          this.addForm.generated_slots = {};
          this.goToNextTab();
        },
      });
    },
    goToNextTab() {
      this.$inertia.visit(route("account"), {
        data: { active_tab: "appointment" },
      });
    },
    updateFeeCommission()
    {
        if (this.isCommissionEnabled()) {
           this.feeAfterCommission =  this.calculateCommissionAmount(this.form.fee,this.commission)
        }
    }
  },
  created() {
    this.getAppointmentschedules();
    if (this.isCommissionEnabled()) {
        this.getAppointmentCommission();
    }
  },
});
</script>

<style lang="scss" scoped>
.time-slots-list ul li {
  width: 155px;
  text-align: center;
}

.time-slots-list ul li span {
  font-size: 12px;
}
</style>
