<template>
    <app-layout title="shop">
        <template #default>
            <div class="section p-0">
                <div class="row mx-0 border-bottom border-dark py-5">
                    <div class="col-12 text-center py-3">
                        <p class="fs-2 mb-0">
                            {{ __("hello") }} {{$page.props.auth.user.name}} |
                            <span class="fw-bold">Make An Appointment</span>
                        </p>
                        <p>Discover The Best Lawyers Near You</p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <Wizard
                                verticalTabs
                                navigable-tabs
                                scrollable-tabs
                                :nextButton="{
                                    text: 'Continue',
                                    icon: 'back',
                                    hideIcon: false, // default false but selected for sample
                                    hideText: false, // default false but selected for sample
                                }"
                                :custom-tabs="[

                                    {
                                        title: 'Information Details',
                                    },
                                    {
                                        title: 'Schedule Appointment',
                                    },
                                    {
                                        title: 'Make a Payment',
                                    },
                                    {
                                        title: 'Start a Video Call',
                                    },
                                    {
                                        title: 'Write a Review',
                                    },
                                ]"
                                :beforeChange="onTabBeforeChange"
                                @change="onChangeCurrentTab"
                                @complete:wizard="wizardCompleted"
                            >
                                <div v-if="currentTabIndex === 0">
                                    <contact-details></contact-details>
                                </div>
                                <div v-if="currentTabIndex === 1">
                                    Schedule Appointment
                                </div>
                                <div v-if="currentTabIndex === 2">
                                    <payment-section></payment-section>
                                </div>
                                <div v-if="currentTabIndex === 3">
                                    <video-call-section></video-call-section>
                                </div>
                                <div v-if="currentTabIndex === 4">
                                    <review-section></review-section>
                                </div>
                            </Wizard>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import ContactDetails from "@/Components/Appointment/ContactDetails.vue";
import PaymentSection from "@/Components/Appointment/PaymentSection.vue";
import ReviewSection from "@/Components/Appointment/ReviewSection.vue";
import VideoCallSection from "@/Components/Appointment/VideoCallSection.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";

import Wizard from "form-wizard-vue3";

export default defineComponent({
    components: {
        AppLayout,
        Navbar,
        ContactDetails,
        PaymentSection,
        ReviewSection,
        VideoCallSection,
        Wizard,
        PageHeader,
    },
    data() {
        return {
            currentTabIndex: 0,
        };
    },
    methods: {
        onChangeCurrentTab(index, oldIndex) {
            this.currentTabIndex = index;
        },
        onTabBeforeChange() {
            if (this.currentTabIndex === 0) {
            }
        },
        wizardCompleted() {
        },
    },
});
</script>

<style lang="scss" scoped>
.form-wizard-vue .fw-step-active {
    background: #fac14d !important;
}
</style>
