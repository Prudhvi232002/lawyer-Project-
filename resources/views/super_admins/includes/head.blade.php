@php
    $site_title = App\Models\GeneralSetting::where('name' , 'site_title')->first();
    $favicon = App\Models\GeneralSetting::where('name', 'favicon')->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ $site_title && $site_title->value ? $site_title->value : env('APP_NAME')}}</title>

    {{-- Favicon --}}
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}"> --}}
    <link rel="icon" href="{{ $favicon && isset($favicon->value) ? asset($favicon->value) . '?v=' . time() : asset('images/favicon.png') . '?v=' . time() }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    @yield('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}"> --}}
    {{-- custom css  --}}
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">



</head>
