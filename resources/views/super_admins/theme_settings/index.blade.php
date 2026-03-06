@extends('super_admins.layouts.master')

@section('title')
    {{ $heading }}
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
    <style>
        .form-control-color {
            width: 50px;
            height: 40px;
            padding: 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    
        .card-header {
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
        }
    
        .btn {
            display: block;
            width: 100%;
        }
    
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    
        .form-check {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
        }
    
        .switch {
            font-size: 17px;
            position: relative;
            display: inline-block;
            width: 3.5em;
            height: 2em;
        }
    
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
    
        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            border: 2px solid #414141;
            border-radius: 50px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    
        .slider:before {
            position: absolute;
            content: "";
            height: 1.4em;
            width: 1.4em;
            left: 0.2em;
            bottom: 0.2em;
            background-color: white;
            border-radius: inherit;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }
    
        .switch input:checked+.slider {
            box-shadow: 0 0 20px rgba(9, 117, 241, 0.8);
            border: 2px solid #0974f1;
        }
    
        .switch input:checked+.slider:before {
            transform: translateX(1.5em);
        }
    
        /* From Uiverse.io by ErzenXz */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 80px;
            height: 40px;
            cursor: pointer;
        }
    
        .toggle-switch input[type="checkbox"] {
            display: none;
        }
    
        .toggle-switch-background {
            position: absolute;
            top: 20px;
            left: 0;
            width: 64%;
            height: 64%;
            background-color: #ddd;
            border-radius: 20px;
            box-shadow: inset 0 0 0 2px #ccc;
            transition: background-color 0.3s ease-in-out;
        }
    
        .toggle-switch-handle {
            position: absolute;
            top: 2px;
            left: 3px;
            width: 20px;
            height: 20px;
            background-color: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }
    
        .toggle-switch::before {
            content: "";
            position: absolute;
            top: -25px;
            right: -35px;
            font-size: 12px;
            font-weight: bold;
            color: #aaa;
            text-shadow: 1px 1px #fff;
            transition: color 0.3s ease-in-out;
        }
    
        .toggle-switch input[type="checkbox"]:checked+.toggle-switch-handle {
            transform: translateX(45px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2), 0 0 0 3px #05c46b;
        }
    
        .toggle-switch input[type="checkbox"]:checked+.toggle-switch-background {
            background-color: #05c46b;
            box-shadow: inset 0 0 0 2px #04b360;
        }
    
        .toggle-switch input[type="checkbox"]:checked+.toggle-switch:before {
            content: "On";
            color: #05c46b;
            right: -15px;
        }
    
        .toggle-switch input[type="checkbox"]:checked+.toggle-switch-background .toggle-switch-handle {
            transform: translateX(25px);
        }
    
        .width-control {
            width: 55px !important;
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
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('super_admin.theme_settings.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        @foreach ($theme_settings as $theme_code => $settings)
                                            <div style="min-height: 400px" class="col-xl-4 col-md-6 mb-4">
                                                <div class="card border rounded-5 mb-4"
                                                    style="border-radius:25px; height: 100%">
                                                    <div class="card-body p-0 text-center">
                                                        <div style="height: 250px;">
                                                            @if ($theme_code === 'custom')
                                                                <img src="{{ asset('assets/themes/color.png') }}"
                                                                    alt="color-wheel" class="w-100 mb-3"
                                                                    style="border-radius: 25px; object-fit: cover; height: 100%;">
                                                            @endif
                                                            @if ($theme_code === 'theme_1')
                                                                <img src="{{ asset('assets/themes/theme_1.jpg') }}"
                                                                    alt="{{ $theme_code }} image" class="w-100 mb-3"
                                                                    style="border-radius: 25px;  height: 100%; object-fit: cover">
                                                            @endif
                                                            @if ($theme_code === 'theme_2')
                                                                <img src="{{ asset('assets/themes/theme_2.jpg') }}"
                                                                    alt="{{ $theme_code }} image" class="w-100 mb-3"
                                                                    style="border-radius: 25px;  height: 100%; object-fit: cover">
                                                            @endif
                                                            @if ($theme_code === 'default')
                                                                <img src="{{ asset('assets/themes/default.jpg') }}"
                                                                    alt="{{ $theme_code }} image" class="w-100 mb-3"
                                                                    style="border-radius: 25px;  height: 100%; object-fit: cover">
                                                            @endif
                                                        </div>
                                                        {{-- @if ($theme_code === 'custom') --}}
                                                        <h4 class="text-center fs-2 text-black fw-bold">
                                                            {{ ucwords(str_replace('_', ' ', $theme_code)) }}</h4>
                                                        @foreach ($settings as $theme_setting)
                                                            @if ($theme_setting->type === 'color')
                                                                <div class="mb-3">
                                                                    <label for="setting_{{ $theme_setting->id }}"
                                                                        class="form-label d-none">{{ $theme_setting->display_name }}</label>
                                                                    <div style="background: #fac14d3b"
                                                                        class="d-flex  px-3 ps-4 align-items-center justify-content-between">

                                                                        <div class="ms-2">
                                                                            <p class="fs-4 ms-2 mb-0 text-black fw-normal">
                                                                                {{ $theme_setting->display_name }}</p>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <input type="color"
                                                                                class="form-control width-control border-0 bg-transparent form-control-color me-2"
                                                                                id="setting_{{ $theme_setting->id }}"
                                                                                name="theme_setting_value[{{ $theme_setting->id }}]"
                                                                                value="{{ $theme_setting->value }}"
                                                                                {{ $theme_setting->is_editable ? '' : 'disabled' }}>
                                                                            <input style="width: 76px !important"
                                                                                type="text"
                                                                                class="form-control p-0 bg-transparent border-0"
                                                                                value="{{ $theme_setting->value }}"
                                                                                disabled>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <input type="hidden" name="theme_setting_ids[]"
                                                                value="{{ $theme_setting->id }}">
                                                        @endforeach
                                                    </div>

                                                    <div class="d-flex p-3 justify-content-between">

                                                        <label class="toggle-switch mb-0">
                                                            <input type="checkbox" name="active_theme"
                                                                id="theme_{{ $theme_code }}" value="{{ $theme_code }}"
                                                                {{ $settings->first()->is_active ? 'checked' : '' }}
                                                                onclick="ensureSingleSelection(this, '{{ $theme_code }}')">
                                                            <div class="toggle-switch-background">
                                                                <div class="toggle-switch-handle"></div>
                                                            </div>
                                                        </label>
                                                        <button id="apply_{{ $theme_code }}"
                                                            style="border-radius: 9px; display: {{ $settings->first()->is_active ? 'block' : 'none' }};"
                                                            type="submit" class="btn btn-dark w-25 mt-3">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function ensureSingleSelection(selectedCheckbox, themeCode) {
            document.querySelectorAll('input[name="active_theme"]').forEach(checkbox => {
                const applyButton = document.getElementById('apply_' + checkbox.value);
                if (checkbox !== selectedCheckbox) {
                    checkbox.checked = false;
                    if (applyButton) {
                        applyButton.style.display = 'none';
                    }
                }
            });
            const selectedApplyButton = document.getElementById('apply_' + themeCode);
            if (selectedApplyButton) {
                selectedApplyButton.style.display = selectedCheckbox.checked ? 'block' : 'none';
            }
        }
    </script>
@endsection
