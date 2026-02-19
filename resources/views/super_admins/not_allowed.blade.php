@extends('super_admins.layouts.master')
@section('title')
Not Allowed
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="m-0">Not Allowed</h1>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container text-center">
           <div class="row">
            <div class="col-12">
                <i class="fa fa-times text-danger " style="font-size: 500px" aria-hidden="true"></i><br>
                You don't have permission to access this page
            </div>
           </div>
        </div>
    </section>
@endsection

