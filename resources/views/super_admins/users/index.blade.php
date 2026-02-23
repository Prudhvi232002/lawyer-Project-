@extends('super_admins.layouts.master')

@section('title')
    Users
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">All Users</h3>
                            @if (auth()->user()->hasPermission('users.add'))
                                <a href="{{ route('super_admin.users.create') }}" class="btn btn-primary ml-auto">
                                    Add Users</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped admin-table">
                                <thead>
                                    <tr>
                                        <th>SR.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $count = 1;
                                @endphp
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_active ? 'Active' : 'Inactive' }} </td>

                                            <td>
                                                @if ($user->profile_image_path)
                                                <img src="{{ asset($user->profile_image_path) }}" width="75px" height="75px">
                                                @else
                                                N/A
                                                @endif

                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @if (auth()->user()->hasPermission('users.show'))
                                                        <a class="btn btn-primary btn-admin"
                                                            href="{{ route('super_admin.users.show', ['user' => $user->id]) }}"><i
                                                                class="fa-solid fa-eye"></i></a>
                                                    @endif
                                                    @if (auth()->user()->hasPermission('users.edit'))
                                                        <a class="btn btn-primary ml-2 btn-admin"
                                                            href="{{ route('super_admin.users.edit', ['user' => $user->id]) }}"><i
                                                                class="fa-solid fa-pen-to-square "></i></a>
                                                    @endif
                                                    {{-- edit --}}
                                                    @if (auth()->user()->hasPermission('users.delete'))
                                                        <button type="button" class="btn btn-danger ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $user->id }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    @endif
                                                    {{-- delete --}}
                                                </div>
                                                <div class="modal fade" id="deleteModal{{ $user->id }}"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Warning</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>This action is irreversible. Are You Sure , You want to
                                                                    delete this user permanently ?</p>
                                                            </div>
                                                            <form
                                                                action="{{ route('super_admin.users.destroy', ['user' => $user->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit" class="btn btn-danger">Delete
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    @include('super_admins.includes.datatable_scripts')
@endsection
