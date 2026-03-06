<template>
  <div :class="{ 'col-md-4 col-law_firm': add_col, 'w-100': !add_col }">
    <div class="w-100 h-100 mb-4 px-md-5">
        <div
            class="card shadow-sm p-4 border"
        >
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-3">
      <i v-if="law_firm.is_featured" class="bi text-secondary bi-patch-check-fill position-absolute top-0 start-0 ms-2 fs-2" style="z-index: 2;"></i>

                        <Link
                        :href="route('law_firm.profile', { 'user_name': law_firm.user_name })"
                        >
                            <div
                                class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                                style="height: 200px"
                            >
                                <img v-if="law_firm.image"
                                    class="img-fluid"
                                    :src="law_firm.image"
                                    alt="law"
                                />
                                <img v-if="!law_firm.image"
                                    class="img-fluid"
                                    src="@/images/account/default_avatar_men.png"
                                    alt="law"
                                />
                            </div>
                        </Link>
                    </div>
                    <div class="col-lg-9">
                        <div
                            class="d-md-flex align-items-center justify-content-between"
                        >
                            <div
                                class="d-flex mb-md-0 mb-3 flex-column align-items-start"
                            >
                                <h2
                                    class="mb-0 fs-5 text-capitalize"
                                >
                                    <Link :href="route('law_firm.profile', { 'user_name': law_firm.user_name })"
                                        class="text-decoration-none text-dark"
                                        >{{ law_firm.name }}</Link
                                    >
                                </h2>
                            </div>
                        </div>

                        <div class="my-2 d-flex align-items-csnter" v-if="law_firm.law_firm_categories.length > 0">
                            <span class="fw-bold"> {{ __("speciality") }}:</span>
                            <ul
                                class="list-unstyled d-md-flex align-items-center ms-3"
                            >
                                <li
                                v-for="(category,index) in law_firm.law_firm_categories" :key="index"
                                    class="me-3 pe-3 border-end"
                                    style="font-size: 12px"
                                >
                                {{ category.name }}
                                </li>
                            </ul>
                        </div>
                        <div
                            style="font-size: 14px"
                            class="text-start"
                        >
                            <p> {{ law_firm.description }}</p>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4 text-start">
                                <Link :href="route('law_firm.profile', {user_name: law_firm.user_name,})"

                                    class="btn btn-primary btn-sm"
                                >
                                    {{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}
                            </Link>
                            </div>
                            <div class="col-lg-4 text-start">
                                <div
                                    class="d-flex align-items-center justify-content-start me-4"
                                >
                                    <span class="mt-1 me-2"
                                        >{{
                                            __("rating")
                                        }}
                                        ({{law_firm.rating}}/5)</span
                                    >
                                    <span class="text-white" style="color: #f5d812;">
                                        <star-rating :rating="law_firm.rating" :star-size="18" :read-only="true" :increment="0.01"
                                        :show-rating="false"></star-rating>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4 text-start" v-if="checkObjectValuesIsNotNull(law_firm.law_firm_settings)">
                                <div class="d-flex flex-column align-items-start">
                                <h6 class="fs-6 fw-bold text-capitalize">{{ __("socials") }}</h6>
                                <ul class="d-flex flex-wrap justify-content-end ps-0 mb-0 list-group list-group-horizontal">
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.facebook_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .facebook_url
                                        "><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0  bg-transparent border-0" v-if="law_firm.law_firm_settings.youtube_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .youtube_url
                                        "><i class="bi bi-youtube"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.twitter_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .twitter_url
                                        "><i class="bi bi-twitter"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.linkedin_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .linkedin_url
                                        "><i class="bi bi-linkedin"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.whatsapp_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .whatsapp_url
                                        "><i class="bi bi-whatsapp"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.instagram_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .instagram_url
                                        "><i class="bi bi-instagram"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.tiktok_url">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .tiktok_url
                                        "><i class="bi bi-tiktok"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.snapchat_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .snapchat_url
                                        "><i class="bi bi-snapchat"></i></a>
                                    </li>
                                    <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="law_firm.law_firm_settings.pinterest_url
                                    ">
                                    <a target="_blank" class="text-dark" :href="law_firm.law_firm_settings
                                        .pinterest_url
                                        "><i class="bi bi-pinterest"></i></a>
                                    </li>
                                </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-3 law-firm-lawyer" v-if="law_firm.law_firm_lawyers.length>0">
                    <div class="col-12 text-start text-capitalize">
                        <h3>{{ law_firm.name }} {{__('lawyers') }}</h3>
                    </div>
                    <div class="col-12">
                        <featured-lawfirm-lawyer-section
                        class="pt-2"
                        findLawyers="true"
                        :law_firm_lawyers="law_firm.law_firm_lawyers"
                    ></featured-lawfirm-lawyer-section>
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
import FeaturedLawfirmLawyerSection from "@/Components/LawFirms/FeaturedLawFirmLawyerSection.vue";
export default defineComponent({
  components: {
    Link,
    FeaturedLawfirmLawyerSection
  },
  props: ['law_firm', 'add_col'],
  created() {
  },
  data() {
    return {
    };
  },
  methods: {
  },
});
</script>
