@extends('super_admins.layouts.master')

@section('title')
    System Info
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
      <div class="row align-items-center mb-4 pt-4 pt-lg-0">

          <div class="col-md-7 mb-3 mb-lg-0">
              <h2 class="main-content-title fw-bold mb-0">System Information</h2>
              <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">System Info</li>
              </ol>
          </div>
      </div>
  </div><!-- /.container-fluid -->
</section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">System Information</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            @foreach ($system_info as $key => $value)
                                <tr>
                                    <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('super_admins.includes.datatable_scripts')
@endsection
