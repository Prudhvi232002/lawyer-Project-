<template>
    <app-layout title="Pricing Plan">
        <template #header>

            <!-- Page Heading -->

        </template>
        <template #default>
            <div class="container-fluid py-5 border-bottom border-dark">
                <div class="row">
                    <div class="col-12">
                        <h2 class="fs-2 text-center">
                            <span v-if="$page.props && $page.props.auth && $page.props.auth.user && $page.props.auth.user.name" class="fw-normal">{{ __("Hello") }} {{ $page.props.auth.user.name }} | </span>
                            <span class="fw-bold">{{ __("Pricing Plan") }}</span>
                        </h2>
                        <p class="text-center mb-0">{{ __("discover The Best Lawyers Near You") }}</p>
                    </div>
                </div>
            </div>
            <div class="section pt-0 pricing-plan">

                <div class="container">

                    <div class="row">


                        <div class="col-12 d-flex justify-content-center align-items-center"
                            v-if="!$page.props.auth || ($page.props.auth.logged_in_as != 'lawyer' && $page.props.auth.logged_in_as != 'law_firm')">
                            <ul class="nav nav-pills nav-pills-c mt-4 rounded-pill p-3 text-center d-flex align-items-center justify-content-center" id="profileTabs" role="tablist">
                                <li class="nav-item " role="presentation">
                                    <Link :href="route('pricing', { type: 'lawyer' })" class="nav-link nav-link-c text-dark fw-bold rounded-pill"
                                        :class="{ active: type == 'lawyer' }" type="button" role="tab">{{ __n('lawyer') }}
                                    </Link>
                                </li>
                                <!-- v-if="hasModule('test')" -->
                                <li class="nav-item" role="presentation">
                                    <Link :href="route('pricing', { type: 'law_firm' })" class="nav-link nav-link-c text-dark fw-bold rounded-pill"
                                        :class="{ active: type == 'law_firm' }" type="button" role="tab">{{ __n('law_firm') }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-md-3 mt-5" v-for="pricing_plan in pricing_plans" :key="pricing_plan.id">
                                    <div class="card rounded-lg border price-card">

                                        <div class="card-body px-0 pb-2">
                                            <span class="position-absolute" style="top: -20px; right: -20px;" v-if="$page.props.auth && ($page.props.auth.logged_in_as == 'lawyer' || $page.props.auth.logged_in_as == 'law_firm') && $page.props.auth.user[pricing_plan.type].pricing_plan_id == pricing_plan.id"><i class="bi display-1 text-success bi-check-circle-fill"></i></span>
                                            <div class="px-3">
                                                <h4 class="fw-bold card-title mb-0 "><span class="fw-bold fs-5">{{ pricing_plan.name }}</span><span v-if="!pricing_plan.is_paid"> ({{ __('free') }})</span></h4>
                                                <!-- <p class="card-text mb-2 fs-6">{{ pricing_plan.tagline }}</p> -->
                                                <div class="py-2 mb-1 fs-4 fw-bold">
                                                     {{ getDisplayAmount(pricing_plan.price) }}/<span style="font-size: 14px;"
                                                        class=" fw-normal">{{ __('month') }}</span>
                                                </div>
                                            </div>

                                            <ul class="ps-0 mb-0">
                                                <li v-for="(module, index) in modules" :key="module.id"
                                                    class="bg-light py-2 px-2 mb-1 d-flex justify-content-between align-items-center position-relative"
                                                    :class="{ 'bg-opacity-25': index % 2 != 0 }">
                                                    <div class="d-flex align-items-center">
                                                        <i v-if="pricing_plan.modules.includes(module.module_code)"
                                                            class="bi fs-2 bi-check text-success d-flex"></i>
                                                        <i v-else class="bi fs-2 bi-x d-flex text-danger"></i>
                                                        <span class="ms-2 pe-4">{{ module.display_name }}</span>
                                                    </div>


                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-footer bg-transparent border-0 pb-4">
                                            <Link
                                                v-if="$page.props.auth && ($page.props.auth.logged_in_as == 'lawyer' || $page.props.auth.logged_in_as == 'law_firm') && $page.props.auth.user[pricing_plan.type].pricing_plan_id == pricing_plan.id"
                                                :href="route('pricing.show', { type: pricing_plan.type, slug: pricing_plan.slug })"
                                                class="btn btn-secondary text-white py-2 w-100">{{ __('subscribed') }}
                                            </Link>
                                            <Link v-else
                                                :href="route('pricing.show', { type: pricing_plan.type, slug: pricing_plan.slug })"
                                                class="btn btn-primary  py-2 w-100">{{ __('get this plan') }}</Link>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        Link
    },
    props: ['pricing_plans', 'modules'],
    mounted() {
    },
    data() {
        return {
            type: route().params.type
        }
    },
    created() {

    }

});
</script>
<style scoped>
.nav-pills-c{
    background-color: #f3f3f3 !important;
    width: fit-content !important;
}
.nav-link-c.active{
    box-shadow: 2px 3px 7px #b5b5b5 !important;
}
</style>
