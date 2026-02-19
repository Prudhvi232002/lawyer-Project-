<template>

    <div class="container">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0" >
                <li class="breadcrumb-item" v-for="(breadcrum,index) in breadcrums" :key="index">
                    <Link v-if="breadcrum.link" class="text-decoration-none link-primary" :href="breadcrum.link">{{breadcrum.name}}</Link>
                    <span v-else> {{breadcrum.name}}</span>
                </li>
            </ol>
        </nav>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props:['breadcrums'],
    created() {
    },
    data() {
        return {
        };
    },
    async mounted() {
    },
    methods: {
    },
});
</script>

<style>

</style>
