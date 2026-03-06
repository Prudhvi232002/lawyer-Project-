<template>
    <div class="stats py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <div
                        class="d-flex align-items-center justify-content-center item"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="500"
                    >
                        <i
                            class="bi"
                            :class="$page.props.settings.home_section1_icon"
                        ></i>
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0">
                                {{ $page.props.dashboard_data.total_users}}<span v-if="$page.props.dashboard_data.total_users > 0">+</span>
                            </h3>
                            <span class="">{{__("member")}}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div
                        class="d-flex align-items-center justify-content-center item"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="700"
                    >
                        <i
                            class="bi"
                            :class="$page.props.settings.home_section2_icon"
                        ></i>
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0">
                                {{ $page.props.dashboard_data.total_lawyers }}<span v-if="$page.props.dashboard_data.total_lawyers > 0">+</span>
                            </h3>
                            <span class="">{{__("lawyer")}}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div
                        class="d-flex align-items-center justify-content-center item"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="900"
                    >
                        <i
                            class="bi"
                            :class="$page.props.settings.home_section3_icon"
                        ></i>
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0">
                                {{$page.props.dashboard_data.total_appointments }}<span v-if="$page.props.dashboard_data.total_appointments > 0">+</span>
                            </h3>
                            <span class="">{{__("appointment booked")}}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div
                        class="d-flex align-items-center justify-content-center item"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="1100"
                    >
                        <i
                            class="bi"
                            :class="$page.props.settings.home_section4_icon"
                        ></i>
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0">
                                {{ $page.props.dashboard_data.total_law_frims }}<span v-if="$page.props.dashboard_data.total_law_frims > 0">+</span>
                            </h3>
                            <span class="">{{__n("law_firm")}}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div
                        class="d-flex align-items-center justify-content-center item"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="1300"
                    >
                        <i
                            class="bi"
                            :class="$page.props.settings.home_section5_icon"
                        ></i>
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0">
                                {{ $page.props.dashboard_data.total_events }}<span v-if="$page.props.dashboard_data.total_events > 0">+</span>
                            </h3>
                            <span class="">{{__n("event")}}</span>

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
    created() {
    },
    data() {
        return {};
    },
    methods: {},
});
</script>
