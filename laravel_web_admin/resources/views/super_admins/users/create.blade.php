@extends('super_admins.layouts.master')

@section('title')
    Add User
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

@endsection

@section('content')
    @if ($errors->any())
    @endif
    <section class="content-header pt-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Add User
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('super_admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('super_admin.users.index')}}">Users</a></li>
                        <li class="breadcrumb-item active">
                            Add User
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title mb-0">
                                Add User
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST" action="{{ route('super_admin.users.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputFirstName">Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                    id="InputFirstName" placeholder="Please Enter" aria-describedby="FirstNameError"
                                                    aria-invalid="true">
                                            <span id="FirstNameError" class="error invalid-feedback">
                                                @if ($errors->has('name'))
                                                    {{ $errors->first('name') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                id="InputEmail" placeholder="Please Enter" aria-describedby="EmailError"
                                                aria-invalid="true">
                                            <span id="InputEmail" class="error invalid-feedback">
                                                @if ($errors->has('email'))
                                                    {{ $errors->first('email') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Password</label>
                                            <input type="password" name="password" value="{{ old('password') }}"
                                                class="form-control @if ($errors->has('password')) is-invalid @endif"
                                                id="InputPassword" placeholder="Please Enter"
                                                aria-describedby="PasswordError"
                                                aria-invalid="true">
                                            <span id="InputPassword" class="error invalid-feedback">
                                                @if ($errors->has('password'))
                                                    {{ $errors->first('password') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputImage">Profile Image</label>
                                            <input type="file" name="profile_image_path" multiple
                                                class="form-control p-1 small @if (count($errors->get('profile_image_path'))) is-invalid @endif
                                                @if ($errors->has('profile_image_path')) is-invalid @endif"
                                                id="InputImage" placeholder="Please upload"
                                                aria-describedby="ImageError"
                                                aria-invalid="true">
                                            <span id="InputImage" class="error invalid-feedback">
                                                    @if ($errors->has('profile_image_path'))
                                                    {{ $errors->first('profile_image_path') }}
                                                @endif
                                                </span>
                                        </div>
                                    </div>
                                        @if(isset($roles))
                                        <div class="col-lg-6">
                                            <div class="form-group single-input-admin">
                                                <label for="InputName">Role :</label>
                                                <select id="roles_drop_down" aria-describedby="TenantError"
                                                        aria-invalid="true" class="form-control filter-single curr-sym @if ($errors->has('role')) is-invalid @endif" name="role_code">
                                                    @if(count($roles) > 0)
                                                        <option value="">Please Select</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->role_code}}">{{$role->name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Role Exists</option>
                                                    @endif
                                                </select>
                                                <span id="TenantError" class="error invalid-feedback">
                                                @if ($errors->has('role'))
                                                        {{ $errors->first('role') }}
                                                    @endif
                                            </span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label for="customSwitch1">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" value="1"
                                                    @if (old('is_active')) checked @endif class="custom-control-input"
                                                    id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch1">Select User To Be Active Or Not</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary px-3 py-1 rounded-pill">Submit</button>
                            {{-- </div> --}}
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#roles_drop_down').on('change', function () {
                var role_code = $(this).val();
                if (role_code) {
                    $.ajax({
                        url: "{{ route('super_admin.getPermissionsExceptRole') }}",
                        type: "GET",
                        data: {role_code: role_code},
                        dataType: "json",
                        success: function (data) {
                            if (data) {
                                $('#permissions_check_boxes').empty();
                                $.each(data.data.permissions, function (key, permission) {
                                    $('#permissions_check_boxes').append('<input type="checkbox" name="permissions[]" id="permissions" class="mr-2 permissions" value="' + permission.code + '">' + permission.name + '<br>');
                                });
                                $('.select-all').removeClass('d-none')
                            } else {
                                $('#permissions_check_boxes').empty();
                            }
                        }
                    });
                } else {
                    $('#permissions_check_boxes').empty();
                }
            });
            $("#check-all").click(function () {
                $('.permissions').prop('checked', this.checked);
            });
            $(document).ready(function() {
                $('.select-single').select2();
            });
            $(".filter-single").select2({
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "select2-single-input",
            });
        });
    </script>
@endsection
