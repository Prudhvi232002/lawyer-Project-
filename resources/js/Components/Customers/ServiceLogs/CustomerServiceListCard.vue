<template>
<div>
    <div class="col-12 text-center mb-3" v-if="services.data.length == 0">
        <record-not-found></record-not-found>

    </div>
    <div class="col-12 mb-3" v-for="service in services.data" :key="service.id">
        <div class="card spotlight-card shadow-sm p-4 item-h border-0">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative" style="height: 150px">
                            <img v-if="service.lawyer_image" class="img-fluid" :src="service.lawyer_image" alt="lawyer" />
                            <img v-else-if="service.law_firm_image" class="img-fluid" :src="service.law_firm_image" alt="lawyer" />
                            <img v-else class="img-fluid" src="@/images/account/default_avatar_men.png" alt="lawyer" />
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h2 class="mb-3 fs-6 text-capitalize" v-if="service.lawyer_name">
                                            {{ service.lawyer_name }}
                                        </h2>
                                        <h2 class="mb-3 fs-6 text-capitalize" v-if="service.law_firm_name">
                                            {{ service.law_firm_name }}
                                        </h2>

                                        <div style="font-size: 14px" class="text-start me-5">
                                            <p>
                                                {{ service.question }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 text-end">
                                        <Link :href="route('customer.service_log.detail',{id:service.id})" class="btn btn-primary fw-bold px-3 shadow-sm mb-3 rounded">
                                        {{ __("view details") }}
                                        </Link>

                                        <!-- <button class="btn btn-primary">
                                            {{ __("rescedule") }}
                                        </button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 py-3 bg-primary-light rounded-lg">
                        <div class="col-md-5">
                            <div class="d-md-flex align-items-center">
                                <div class="d-flex align-items-center me-3">
                                    <i class="bi bi-calendar3 me-3 fs-4 text-primary"></i>
                                    <span class="">{{ service.date }}</span>
                                </div>
                                <div class="d-flex align-items-center me-3">
                                    <i class="bi bi-clock-fill me-3 fs-4 text-primary"></i>
                                    <span class="">{{ __('available')}}</span>
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
                        <span class="me-3">{{ __("price") }}</span>
                        <span> {{getDisplayAmount(service.price)}}</span>
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
    RecordNotFound
  },
    props: ['services'],
    data() {
        return {

        };
    },
});
</script>

<style>

</style>
