<template>
    <div :class="{ 'col-md-6 col-events': add_col, 'w-100': !add_col }">
        <div
            class="card item-h shadow-sm rounded-md card-event bg-transparent border-0"
        >
            <div
                class="card-body bg-light bg-opacity-50 rounded-md border overflow-hidden p-0"
            >
                <div class="row mx-0">
                    <div class="col-lg-5 col-md-12  p-0">
                        <div
                            class="d-flex rounded-md card-avatar overflow-hidden position-relative"
                            style=""
                        >
                            <img
                                v-if="event.image"
                                class="img-fluid w-100"
                                :src="event.image"
                                alt="lawyer"
                            />
                            <img
                                v-if="!event.image"
                                class="img-fluid m-3"
                                src="@/images/account/default_avatar_men.png"
                                alt="events"
                            />
                            <div class="item-overlay top"></div>
                            <div class="block--text text-center">
                                <Link :href="route('events.detail', { 'slug': event.slug })"
                                    class="btn btn-primary">  {{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }} </Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 p-0">
                        <div class="p-3 pb-0 text-start">
                            <h3 class="mb-3 fs-5 justify-content-start" style="overflow: hidden;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            line-clamp: 2;
                            -webkit-box-orient: vertical;">
                                {{ event.name }}
                            </h3>
                            <p
                                class=""
                                v-if="
                                    event.description &&
                                    event.description.length > 0
                                "
                            >
                                {{
                                    event.description.substring(0, 100) + "..."
                                }}
                            </p>
                            <p class="" v-else>{{ event.description }}</p>
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
    props: ["event", "add_col"],
    created() {
    },
    data() {
        return {};
    },
    methods: {},
});
</script>
