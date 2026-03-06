@extends('super_admins.layouts.master')

@section('title')
    Lawyer CategorIes
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-4 pt-4 pt-lg-0">

                <div class="col-md-7 mb-3 mb-lg-0">
                    <h2 class="main-content-title fw-bold mb-0">Lawyer Categories</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Lawyer Categories</li>
                    </ol>
                </div>
                <div class="col-md-5">
                    <div class="d-flex justify-content-start justify-content-md-end">
                        @php
                            $params = explode('?', request()->getRequestUri());
                            $params = $params[1] ?? null;
                        @endphp
                        @if (auth()->user()->hasPermission('lawyer_category.export'))
                            <a href="{{ route('super_admin.lawyer_categories.export') }}?{{ $params ? $params : '' }}"
                                class="btn btn-light">
                                <i class="fa fa-upload" aria-hidden="true"></i><span class="ml-2">Export</span>
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('lawyer_category.import'))
                            <button type="button" class="btn btn-light ml-2" data-toggle="modal"
                                data-target="#importModal">
                                <i class="fa fa-download" aria-hidden="true"></i><span class="ml-2">Import</span>
                            </button>
                        @endif
                        @if (auth()->user()->hasPermission('lawyer_category.add'))
                            <a href="{{ route('super_admin.lawyer_categories.create') }}" class="btn btn-primary ml-2">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="ml-2">Add</span>
                            </a>
                        @endif
                        <x-super-admin.import-modal importUrl="{{ route('super_admin.lawyer_categories.import') }}">

                        </x-super-admin.import-modal>
                    </div>
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

                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped admin-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lawyer_categories as $lawyer_category)
                                        <tr>
                                            <td>{{ $lawyer_category->name }}</td>
                                            <td>
                                                @if ($lawyer_category->image)
                                                    <img src="{{ url($lawyer_category->image) }}" width="75px"
                                                        height="75px" alt="{{ $lawyer_category->slug }}">
                                                    &nbsp &nbsp
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ date_format($lawyer_category->created_at, 'd-m-Y') }}</td>

                                            <td>{{ $lawyer_category->is_active ? 'Active' : 'Inactive' }} </td>
                                            <td>
                                                @if (!$lawyer_category->trashed())
                                                    <div class="d-flex">
                                                        @if (auth()->user()->hasPermission('lawyer_category.show'))
                                                            <a class="btn btn-primary"
                                                                href="{{ route('super_admin.lawyer_categories.show', ['lawyer_category' => $lawyer_category->id]) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="View Detail"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                        {{-- view --}}
                                                        @if (auth()->user()->hasPermission('lawyer_category.edit'))
                                                            <a class="ml-2 btn btn-secondary"
                                                                href="{{ route('super_admin.lawyer_categories.edit', ['lawyer_category' => $lawyer_category->id]) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Edit Detail"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                        {{-- edit --}}
                                                        @if (auth()->user()->hasPermission('lawyer_category.delete'))
                                                            <button type="button" class="btn btn-danger ml-2"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $lawyer_category->id }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                        {{-- delete --}}
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $lawyer_category->id }}"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Warning</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>This action is irreversible. Are You Sure , You want
                                                                        to
                                                                        delete this Lawyer Category ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.lawyer_categories.destroy', ['lawyer_category' => $lawyer_category->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                @else
                                                    <div class="d-flex">
                                                        {{-- restore --}}
                                                        <button type="button" class="btn btn-primary ml-2"
                                                            data-toggle="modal"
                                                            data-target="#restoreModal{{ $lawyer_category->id }}">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </button>
                                                        {{-- delete permanently --}}
                                                        <button type="button" class="btn btn-danger ml-2"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $lawyer_category->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $lawyer_category->id }}"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Warning</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>This action is irreversible. Are You Sure , You want
                                                                        to
                                                                        delete this Lawyer Category permanently ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.lawyer_categories.destroy_permanently', ['lawyer_category' => $lawyer_category->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <div class="modal fade" id="restoreModal{{ $lawyer_category->id }}"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Warning</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are You Sure , You want
                                                                        to
                                                                        restore this Lawyer Category ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.lawyer_categories.restore', ['lawyer_category' => $lawyer_category->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Restore</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                @endif

                                            </td>
                                        </tr>
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
