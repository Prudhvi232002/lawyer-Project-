<template>
    <div :class="{ 'col-md-4 col-reviews': add_col, 'w-100': !add_col }">
        <div class="card card-alt overflow-hidden border-0" style="border-radius: 30px;">
               
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-items-center overflow-hidden bg-light rounded-circle"
                        style="width: 45px; height: 45px;">
                        <img class="img-fluid" :src="review.customer.image" alt="image">

                    </div>
                    <span class="ms-3">{{ __('by') }} {{ review.customer.name }}</span>
                </div>

                <p class="fst-italic lh-1 text-center mb-3" style="color: #C5C4C7;">
                    {{ review.comment }}
                </p>

                <div class="d-flex align-items-center">
                    <span class="rating text-warning">
                        <star-rating :rating="review.rating" :star-size="18" :read-only="true" :increment="0.01" :show-rating="false"></star-rating>
                    </span>
                    <span class="ms-3">{{ getFormattedDateOnly(review.created_at) }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props:['review','add_col'],
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
