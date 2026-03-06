<template>
    <div :class="{ 'col-md-4 col-reviews': add_col, 'w-100': !add_col }">
        <div class="card card-alt overflow-hidden border shadow-sm rounded-md">

            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <i class="bi bi-quote fs-1"></i>
                    <h5 class="ms-3"> {{ review.customer.name }}</h5>
                    <div class="d-flex align-items-center overflow-hidden bg-light rounded-circle"
                        style="width: 70px; height: 70px;">
                        <img class="img-fluid" :src="review.customer.image" alt="image">

                    </div>


                </div>

                <p class="text-center mb-3" style="color: #C5C4C7;">
                    {{ review.comment }}
                </p>

                <div class="d-flex align-items-center justify-content-center">
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
