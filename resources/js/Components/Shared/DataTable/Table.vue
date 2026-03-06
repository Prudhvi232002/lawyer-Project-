<template>
        <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">
                                <slot name="TableHeaderTitle">
                                </slot>
                            </h3>
                            <div class="ml-auto">
                                <slot name="TableHeaderButtons">
                                </slot>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped admin-table">
                                <thead>
                                    <slot name="TableTheadRow">
                                    </slot>
                                </thead>
                                <tbody>
                                    <slot name="TableBody">
                                    </slot>
                                </tbody>

                            </table>
                            <slot name="Pagination">
                            </slot>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
</template>

