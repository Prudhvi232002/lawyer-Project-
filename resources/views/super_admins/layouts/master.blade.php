@include('super_admins.includes.head')
@php
    $site_logo = App\Models\GeneralSetting::where('name', 'logo')->first();
    $primary_color = App\Models\ThemeSetting::where('color', 'primary_color')
        ->whereNot('theme_code', 'default')
        ->active()
        ->first();
    $secondary_color = App\Models\ThemeSetting::where('color', 'secondary_color')
        ->whereNot('theme_code', 'default')
        ->active()
        ->first();
        // dd($primary_color);
        // dd($secondary_color);
@endphp

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="background:rgb(38, 46, 57);">
            <img class="animation__shake"
                src="{{ $site_logo && $site_logo->value ? asset($site_logo->value) : asset('images/logo.png') }}"
                alt="Consultant" height="50">
        </div>
        <style>
            :root {
                --primary: #a7916d;
                --secondary: #232A2D;
                --body-bg: #f1efeb;
                --white: #fff;

                @php $primary_color_rgb =hexToRgb($primary_color && $primary_color->value ? $primary_color->value : '#FAC14D');
                $secondary_color_rgb =hexToRgb($secondary_color && $secondary_color->value ? $secondary_color->value : '#262929');
                $primary_color =$primary_color && $primary_color->value ? $primary_color->value : '#FAC14D';
                $secondary_color =$secondary_color && $secondary_color->value ? $secondary_color->value : '#262929';
               
            @endphp
            --primary: {{ $primary_color }};
            --secondary: {{ $secondary_color }};
            }
        </style>
        @include('super_admins.includes.navbar')
        @include('super_admins.includes.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper p-lg-4">
            @yield('content')
        </div>
        @include('super_admins.includes.footer')
        @include('super_admins.includes.foot')
