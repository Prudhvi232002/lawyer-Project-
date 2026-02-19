<template>
        <div :class="{'col-md-6':add_col}">
            <div class="card item-h card-alt overflow-hidden border-0 shadow-sm rounded-md mb-4" >
                <div class="d-flex justify-content-center overflow-hidden card-avatar position-relative" style="height: 300px;">
                    <img v-if="broadcast.image" class="img-fluid w-100" :src="broadcast.image" alt="image">
                    <img v-else class="img-fluid" src="@/images/common/media.png" alt="image">
                    <div class="item-overlay top"></div>
                    <div class="icon mx-3 position-absolute end-0 bottom-0 block--text text-center">
                        <Link :href="route('broadcasts.detail',{slug:broadcast.slug})"  class="btn btn-primary">{{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}</Link>
                    </div>
                </div>
                <div class="card-body">

                    <h5 class="fixed-title mb-0"><a class="text-decoration-none text-dark" :href="route('broadcasts.detail', { slug: broadcast.slug })">{{ broadcast.name }}</a></h5>
                    <span v-if="broadcast.lawyer_id" class="badge bg-secondary">Lawyer</span>
                    <span v-else-if="broadcast.law_firm_id" class="badge bg-secondary">LawFirm</span>
                    <span v-else class="badge bg-secondary">Admin</span>
                    <p class="mb-0 mt-3 lineclamp-2" v-html="broadcast.description"></p>

                </div>
            </div>
        </div>
</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";
import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";

export default defineComponent({
  components: {
    Link,
    CardSkeleton
  },
  props:{
    'broadcast':{},
    'add_col':{
        default:true
    },

},
  created(){

  },
  data() {
    return {
    };
  },
  methods: {
  },
});
</script>
