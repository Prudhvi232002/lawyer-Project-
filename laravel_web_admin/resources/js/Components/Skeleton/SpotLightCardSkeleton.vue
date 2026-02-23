<template>
    <div class="w-100 item skeleton-structure listView" :class="{ item: add_col }">
        <div class="card spotlight-card item-h border-0 p-3 bg-transparent shadow-none" style="max-width: 100%;">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-3">
                            <div
                                class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                                style="height: 205px"
                            >
                                <div class="img">

                                </div>

                            </div>
                            <div class="d-flex align-items-center justify-content-center">      <div class="title mt-2"></div></div>

                    </div>
                    <div class="col-md-9 mt-3 mt-md-0">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <div class="title"></div>  <div class="button btn-sm mt-3 mt-md-0"></div>
                        </div>

                        <div class="description mx-0 my-4">
                            <div class="line line-1"></div>
                            <div class="line line-2"></div>
                            <div class="line line-3"></div>
                        </div>

                        <div class="row d-none d-md-flex">
                            <div class="col-md-3">
                                <div class="title mb-2"></div>
                                <div class="title"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="title mb-2"></div>
                                <div class="title"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="title mb-2"></div>
                                <div class="title"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="title mb-2"></div>
                                <div class="title"></div>
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
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: ["lawyer", "add_col", "list_card"],
    created() {},
    data() {
        return {};
    },
    methods: {},
});
</script>
