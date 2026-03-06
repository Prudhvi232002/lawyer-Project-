<template>
    <div class="static-cards">
        <div class="container">
            <div class="row">
                <div class="col-12" v-if="getPageContentType('category_section_description') == 'textarea'">
                                      <div v-html="getPageContent('category_section_description')"> </div>
                                    </div>
                        <div class="col-12" v-else-if="getPageContentType('category_section_description') == 'text'">
                            <p> {{getPageContent('category_section_description') ?? '-'}} </p>
                    </div>

                <div v-else class="col-12">
                    <h2
                        class="display-6 text-center"
                        data-aos="fade-down"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="200"
                    >
                        {{ __("Law Categories") }}
                    </h2>
                    <p class="mb-5 text-center">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Quidem, quasi explicabo, animi, molestias cumque
                        porro vel facere nostrum numquam aperiam ex harum non.
                        Ullam, rem. Reprehenderit, tenetur eveniet. Molestias,
                        culpa.
                    </p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row row-cols-md-12 align-items-center">
                <div class="col hvr-float d-md-block d-flex align-items-center justify-content-center mb-3" v-for="(category,index) in lawyer_main_categories" :key="index" >
                    <Link
                    v-if="index <= 4"
                        class="text-decoration-none text-center"
                        :href="
                            route('categories')
                        "
                    >
                        <div
                            class="item text-center p-4"
                            data-aos="fade-up"
                            data-aos-once="false"
                            data-aos-duration="1500"
                        >
                            <!-- <i class="bi" :class="$page.props.settings.home_section1_icon"></i> -->
                            <img
                                :src="category.icon"
                                alt
                                class="img-fluid"
                            />
                            <h6 class="mt-3 text-dark fw-bolder fixed-title" >
    {{category.name}}
</h6>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
        <!-- <categories-block-skeleton></categories-block-skeleton> -->

    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import CategoriesBlockSkeleton from "@/Components/Skeleton/CategoriesBlockSkeleton.vue";
export default defineComponent({
    components: {
        Link,
        CategoriesBlockSkeleton
    },
    created() {
    this.getLawyerMainCategories();
    },
    data() {
        return {
            lawyer_main_categories:[]
        };
    },
    methods: {
        getLawyerMainCategories() {
      axios.get(this.route("getApiFeaturedLawyerCategories")).then((res) => {
        this.lawyer_main_categories = res.data.data;
      });
    },
    },

});

</script>



