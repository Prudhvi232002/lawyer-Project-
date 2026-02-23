@extends('super_admins.layouts.master')

@section('title')
    LawFirm CategorIes
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
                    <h2 class="main-content-title fw-bold mb-0">LawFirm Main Categories</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">LawFirm Main Categories</li>
                    </ol>
                </div>

                <div class="col-md-5">
                    <div class="d-flex justify-content-start justify-content-md-end">
                        @php
                            $params = explode('?', request()->getRequestUri());
                            $params = $params[1] ?? null;
                        @endphp
                        @if (auth()->user()->hasPermission('law_firm_main_category.export'))
                            <a href="{{ route('super_admin.law_firm_main_categories.export') }}?{{ $params ? $params : '' }}"
                                class="btn btn-light">
                                <i class="fa fa-upload" aria-hidden="true"></i><span class="ml-2">Export</span>
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('law_firm_main_category.import'))
                            <button type="button" class="btn btn-light ml-2" data-toggle="modal"
                                data-target="#importModal">
                                <i class="fa fa-download" aria-hidden="true"></i><span class="ml-2">Import</span>
                            </button>
                        @endif
                        @if (auth()->user()->hasPermission('law_firm_main_category.add'))
                            <a href="{{ route('super_admin.law_firm_main_categories.create') }}"
                                class="btn btn-primary  ml-2">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="ml-2">Add</span>
                            </a>
                        @endif
                        <x-super-admin.import-modal importUrl="{{ route('super_admin.law_firm_main_categories.import') }}">

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
                                    @foreach ($law_firm_main_categories as $law_firm_main_category)
                                        <tr>
                                            <td>{{ $law_firm_main_category->name }}</td>
                                            <td>
                                                @if ($law_firm_main_category->image)
                                                    <img src="{{ url($law_firm_main_category->image) }}" width="75px"
                                                        height="75px" alt="{{ $law_firm_main_category->slug }}">
                                                    &nbsp &nbsp
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ date_format($law_firm_main_category->created_at, 'd-m-Y') }}</td>

                                            <td>{{ $law_firm_main_category->is_active ? 'Active' : 'Inactive' }} </td>
                                            <td>
                                                @if (!$law_firm_main_category->trashed())
                                                    <div class="d-flex">
                                                        @if (auth()->user()->hasPermission('law_firm_main_category.show'))
                                                            <a class="btn btn-primary"
                                                                href="{{ route('super_admin.law_firm_main_categories.show', ['law_firm_main_category' => $law_firm_main_category->id]) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="View Detail"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                        @if (auth()->user()->hasPermission('law_firm_main_category.edit'))
                                                            <a class="ml-2 btn btn-secondary"
                                                                href="{{ route('super_admin.law_firm_main_categories.edit', ['law_firm_main_category' => $law_firm_main_category->id]) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Edit Detail"><i class="fa fa-edit"></i></a>
                                                            {{-- edit --}}
                                                        @endif
                                                        @if (auth()->user()->hasPermission('law_firm_main_category.delete'))
                                                            <button type="button" class="btn btn-danger ml-2"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $law_firm_main_category->id }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                        {{-- delete --}}
                                                    </div>
                                                @else
                                                    <div class="d-flex">
                                                        {{-- restore --}}
                                                        <button type="button" class="btn btn-primary ml-2"
                                                            data-toggle="modal"
                                                            data-target="#restoreModal{{ $law_firm_main_category->id }}">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </button>
                                                        {{-- delete permanently --}}
                                                        <button type="button" class="btn btn-danger ml-2"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $law_firm_main_category->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif


                                            </td>

                                            <div class="modal fade" id="deleteModal{{ $law_firm_main_category->id }}"
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
                                                            <p>This action is irreversible. Are You Sure , You want
                                                                to
                                                                delete this LawFirm Category permanently ?</p>
                                                        </div>
                                                        <form
                                                            action="{{ route('super_admin.law_firm_main_categories.destroy', ['law_firm_main_category' => $law_firm_main_category->id]) }}"
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
                                            <div class="modal fade" id="restoreModal{{ $law_firm_main_category->id }}"
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
                                                            <p>Are You Sure , You want
                                                                to
                                                                restore this LawFirm Main Category ?</p>
                                                        </div>
                                                        <form
                                                            action="{{ route('super_admin.law_firm_main_categories.restore', ['law_firm_main_category' => $law_firm_main_category->id]) }}"
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
