
@extends('super_admins.layouts.master')

@section('title', 'About & Update')

@section('css')
    <style>
        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 20px;
        }
        .btn-primary {
           
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .text-primary {
            color: #6d28d9;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4 pt-4 pt-lg-0">

            <div class="col-sm-6">
                <h2 class="main-content-title fw-bold mb-0">{{ $heading }}</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"> {{ $heading }} </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <h5>Upload From Local Directory</h5>
                    <form method="POST" action="{{ route('super_admin.version_upgrade.upgrade') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="zipFile">Browse</label>
                            <input type="file" name="zip_file" accept=".zip" class="form-control" id="zipFile">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <h5>About System</h5>
                    <table class="table">
                        <tr><td>Software Version</td><td class="text-primary">{{ $application_current_version->value }}</td></tr>
                        <tr><td>Check update</td><td><a href="#" class="text-primary">Update</a></td></tr>
                        <tr><td>PHP Version</td><td>{{ phpversion() }}</td></tr>
                        <tr><td>Laravel Version</td><td>{{ app()->version() }}</td></tr>
                        <tr><td>Curl Enable</td><td>{{ function_exists('curl_version') ? 'Enabled' : 'Disabled' }}</td></tr>
                        <tr><td>Max upload Size</td><td>{{ ini_get('upload_max_filesize') }}</td></tr>
                        <tr><td>Purchase Code</td><td>Verified</td></tr>
                        <tr><td>Install Domain</td><td><a href="{{ url('/') }}" class="text-primary">{{ url('/') }}</a></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection