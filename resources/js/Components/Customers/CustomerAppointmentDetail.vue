<template>
    <div>
        <div class="container-fluid py-5 border-bottom border-dark">
            <div class="row">
                <div class="col-12">
                    <h2 class="fs-2 text-center">
                        <span class="fw-normal">{{ __("Hello") }} {{ $page.props.auth.user.name }} | </span>
                        <span class="fw-bold">{{ __("appointment detail") }}</span>
                    </h2>
                    <!-- <p class="text-center mb-0">{{ __("discover The Best Lawyers Near You") }}</span> -->
                </div>
                <breadcrums :breadcrums="breadcrums"></breadcrums>
            </div>
        </div>
        <div class="section py-5">
            <div class="container">
                <div class="px-4 mb-0 rounded py-4" style="background-color: var(--tertiary-color)">
                    <div class="row">
                        <div class="col-12">
                            <div v-if="appointment.appointment_type_id == 1 && appointment.appointment_status_code != 5">
                                <video-call-component :appointment="appointment"></video-call-component>
                            </div>
                            <div v-if="appointment.appointment_type_id == 2 && appointment.appointment_status_code != 5">
                                <audio-call-component :appointment="appointment"></audio-call-component>
                            </div>
                            <div v-if="appointment.appointment_type_id == 3 && appointment.appointment_status_code != 5">
                                <div class="row" v-if="appointment.appointment_status_code == 1">
                                    <div class="col-md-6">
                                        <p class="mb-0">{{ __("Waiting for Appointment Acceptance") }}</p>
                                    </div>
                                </div>
                                <div v-if="appointment.appointment_status_code == 2">

                                    <chat-component :appointment="appointment"></chat-component>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="pt-4">
                            <div class="row">
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-calendar-x fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('booking date') }}</h5>
                                            <span>{{ appointment.date }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 d-flex" v-if="appointment.is_schedule_required">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-clock-history fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('start time') }}</h5>
                                            <span>{{ appointment.start_time }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 d-flex" v-if="appointment.is_schedule_required">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-clock-history fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('end time') }}</h5>
                                            <span>{{ appointment.end_time }}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 d-flex" v-if="appointment.lawyer_name">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-person-circle fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('lawyer') }}</h5>
                                            <span>{{ appointment.lawyer_name }}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 d-flex" v-if="appointment.law_firm_name">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-person-circle fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('law_firm') }}</h5>
                                            <span>{{ appointment.law_firm_name }}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-clipboard-check fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('appointment status') }}</h5>
                                            <span>{{ appointment.appointment_status_name }}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-webcam fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('appointment type') }}</h5>
                                            <span>{{ appointment.appointment_type_name }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 justify-content-between align-items-center d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-check2-square fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('payment status') }}</h5>
                                            <span>{{ appointment.is_paid ? __('paid') : __('un Paid') }}</span>
                                        </div>
                                    </div>
                                    <Link v-if="!appointment.is_paid"
                                        :href="route('user.addFund.confirm', { 'transaction': appointment.fund.transaction, 'appointment_id': appointment.id })"
                                        class="btn btn-secondary rounded-4 btn-sm px-3 h-auto"> {{
                                            __('pay')
                                        }}
                                    </Link>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-coin fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('fee') }}</h5>
                                            <span> {{ getDisplayAmount(appointment.fee)  }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-question-circle fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('question') }}</h5>
                                            <span>{{ appointment.question }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-question-circle fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('Payment Method') }}</h5>
                                            <span>{{  gateway?.name ?? 'wallet' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-file-earmark-post fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('attachment') }}</h5>
                                            <img :src="appointment.attachment_url" height="100" width="100"
                                                v-if="appointment.attachment_url" alt="">
                                            <span v-else>{{ __('n/a') }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-5" v-if="appointment.appointment_status_code == 5 && !userRating">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button type="updatenStatus" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#ratingModel">
                                            {{ __("rate now") }}
                                        </button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ratingModel" tabindex="-1"
                                        aria-labelledby="ratingModelLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ratingModelLabel">Rate Now</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="rating">{{ __('rating') }}:</label>
                                                    <div class="rating text-center fs-3 text-warning">
                                                        <star-rating v-model="form.rating" @update:rating="setRating"
                                                            :star-size="25"></star-rating>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">{{ __('comment') }}:</label>
                                                        <textarea v-model="form.comment" class="form-control" id=""
                                                            cols="30" rows="3"></textarea>
                                                        <span v-if="form.errors.comment">
                                                            {{ form.errors.comment }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" id="close"
                                                        data-bs-dismiss="modal">{{ __('close') }}</button>
                                                    <button type="button" @click="submit" class="btn btn-primary">{{
                                                        __('submit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="appointment.appointment_status_code == 5 && userRating">
                                    <div class="col-md-4 d-flex">
                                        <div class="d-flex align-items-center mb-3">
                                            <div>
                                                <h5 class="mb-0 text-capitalize">{{ __('feedback') }}</h5>
                                                <b>{{ __('rating') }}: </b>
                                                <star-rating :rating="userRating.rating" :star-size="20" :read-only="true"
                                                    :increment="0.01" :show-rating="false"></star-rating>
                                                <b>{{ __('comment') }}: </b> {{ userRating.comment }}
                                            </div>
                                        </div>

                                    </div>
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
import AppLayout from "@/Layouts/AppLayout.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ChatComponent from "@/Components/Shared/Appointment/ChatComponent.vue";
import VideoCallComponent from "@/Components/Shared/Appointment/VideoCallComponent.vue";
import AudioCallComponent from "@/Components/Shared/Appointment/AudioCallComponent.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
    components: {
        Head,
        AppLayout,
        ValidationErrors,
        ChatComponent,
        AudioCallComponent,
        VideoCallComponent,
        Link,
        Breadcrums
    },
    props: ['appointment','gateway'],
    data() {
        return {
            form: this.$inertia.form({
                comment: "",
                rating: 0,
                lawyer_id: this.appointment.lawyer_id,
                booked_appointment_id: this.appointment.id
            }),
            breadcrums: [
                {
                    id: 1,
                    name: 'Home',
                    link: '/'
                },
                {
                    id: 2,
                    name: 'My Appointments',
                    link: '/appointment_log'
                },
                {
                    id: 3,
                    name: 'Appointment Detail',
                    link: ''
                }
            ]
        };
    },
    async created() {
    },
    mounted() {

    },
    computed: {
        userRating() {
            var variable = this.appointment.ratings.find(rating => rating.fromable_type == this.$page.props.auth.logged_in_as && rating.fromable_id == this.$page.props.auth.user[this.$page.props.auth.logged_in_as].id);
            return variable;
        },


    },
    methods: {
        close() {
            document.getElementById('close').click()
        },
        resetForm() {
            this.form = this.$inertia.form({
                comment: "",
                rating: 0,

            })
        },
        setRating(rating) {
            this.form.rating = rating
        },
        submit() {
            this.form.post(this.route('add_appointment_rating'), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    const modalBackdrop = document.querySelector('.modal-backdrop');
                    if (modalBackdrop) {
                        modalBackdrop.classList.remove('modal-backdrop');
                    }
                    this.resetForm()
                },
            })
        },
    },
});
</script>

