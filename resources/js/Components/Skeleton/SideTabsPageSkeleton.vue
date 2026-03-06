<template>
    <div  class="skeleton-structure">
        <div class="row">
            <div class="col-md-3 py-5">
                <ul class="tags ps-0 mb-0">
                    <li class="item bg-skeleton d-inline-block m-2 me-2">
                        <div style="height: 40px; width: 200px"></div>
                    </li>

                    <li class="item bg-skeleton d-inline-block m-2 me-2">
                        <div style="height: 40px; width: 200px"></div>
                    </li>

                    <li class="item bg-skeleton d-inline-block m-2 me-2">
                        <div style="height: 40px; width: 200px"></div>
                    </li>

                    <li class="item bg-skeleton d-inline-block m-2 me-2">
                        <div style="height: 40px; width: 200px"></div>
                    </li>

                    <li class="item bg-skeleton d-inline-block m-2 me-0">
                        <div style="height: 40px; width: 200px"></div>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 py-5 ps-4 border-start border-dark">
                <div class="spotlight-card bg-white shadow-sm p-4 mb-4 item-h border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-3">
                                    <div
                                        class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                                        style="height: 180px"
                                    >
                                        <div class="img">

                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-9">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="title"></div>  <div class="button btn-sm"></div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <div class="description w-100 my-4 me-4">
                                        <div class="line line-1"></div>
                                        <div class="line line-2"></div>
                                        <div class="line line-3"></div>
                                    </div>
                                     <div class="button btn-sm"></div>
                                </div>



                            </div>
                            <div class="col-12"> <div class="item bg-skeleton w-100 rounded " >
                                <div style="height: 50px; width:100%" ></div>
                            </div></div>
                        </div>
                    </div>
                </div>
                <div class="spotlight-card bg-white shadow-sm p-4 mb-4 item-h border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-3">
                                    <div
                                        class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                                        style="height: 180px"
                                    >
                                        <div class="img">

                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-9">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="title"></div>  <div class="button btn-sm"></div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <div class="description w-100 my-4 me-4">
                                        <div class="line line-1"></div>
                                        <div class="line line-2"></div>
                                        <div class="line line-3"></div>
                                    </div>
                                     <div class="button btn-sm"></div>
                                </div>



                            </div>
                            <div class="col-12"> <div class="item bg-skeleton w-100 rounded " >
                                <div style="height: 50px; width:100%" ></div>
                            </div></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
    props: [ 'add_col'],
});
</script>

<style></style>
