@php
    $site_title = App\Models\GeneralSetting::where('name', 'site_title')->first();
    $is_ai_chatbot_enable = App\Models\GeneralSetting::where('name', 'is_ai_chatbot_enable')->first();
    $favicon = App\Models\GeneralSetting::where('name', 'favicon')->first();
    $primary_color = App\Models\ThemeSetting::where('color', 'primary_color')->whereNot('theme_code','default')->active()->first();
    $secondary_color = App\Models\ThemeSetting::where('color', 'secondary_color')->whereNot('theme_code','default')->active()->first();
    // dd($favicon && $favicon->value ? asset($favicon->value) : asset('images/favicon.png'));


    $meta_description = App\Models\GeneralSetting::where('name', 'meta_description')->first();
    $seo_title = App\Models\GeneralSetting::where('name', 'seo_title')->first();
    $social_description = App\Models\GeneralSetting::where('name','social_description')->first();
    $seo_meta_keywords = App\Models\GeneralSetting::where('name','meta_keywords')->first();
    $keywords = $seo_meta_keywords && $seo_meta_keywords->value 
                ? implode(', ', json_decode($seo_meta_keywords->value, true)) 
                : 'law-advisor, keywords, for, site';

@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }}</title>
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}"> --}}

    <link rel="icon" href="{{ $favicon && isset($favicon->value) ? asset($favicon->value) . '?v=' . time() : asset('images/favicon.png') . '?v=' . time() }}" />


     {{-- SEO --}}

     <meta name="keywords" content="{{ $keywords }}">
     <meta name="description" content="{{ $meta_description && $meta_description->value ? $meta_description->value : 'LandAdvisor description for the site.' }}">
     {{-- <meta name="keywords" content="{{ $seo_meta_keywords && $seo_meta_keywords->value ? $seo_meta_keywords->value : 'LandAdvisor, keywords, for, site' }}"> --}}
     <meta property="og:title" content="{{ $seo_title && $seo_title->value ? $seo_title->value : config('app.name', 'Admin') }}">
     <meta property="og:description" content="{{ $social_description && $social_description->value ? $social_description->value : 'LandAdvisor social media description for the site.' }}">
     <meta property="og:image" content="{{ $favicon && isset($favicon->value) ? asset($favicon->value) . '?v=' . time() : asset('images/favicon.png') }}">
     <meta property="og:url" content="{{ url()->current() }}">

    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>

    {{-- @if(config('app.env') == 'local')
        @routes
    @endif --}}
    <script>
        window.Laravel = {
            env: @json(config('app.env'))
        };
    </script>
    @vite('resources/js/app.js')
    @inertiaHead
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCiLJ2oj495NdwWjSm3I_fBGX7UxYYW6s&libraries=places">
    </script>


</head>

<body class="font-sans antialiased">

    @inertia
    @include('colors')
</body>

@if ($is_ai_chatbot_enable->value == 1)

    <script>
        var botmanWidget = {
            title: '{{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }}',
            aboutText: 'Developed By Hexathemes',
            mainColor: '{{ $secondary_color && $secondary_color->value ? $secondary_color->value : '#262929' }}',
            aboutLink: 'https://lawadvisor-demo.hexathemes.com/',
            bubbleBackground: '{{ $secondary_color && $secondary_color->value ? $secondary_color->value : '#262929' }}',
            bubbleAvatarUrl: '{{ asset('assets/botman/group.png') }}',
            introMessage: "✋ Hello! Welcome to <b>{{ $site_title->value }}</b>. How can I assist you today with your legal needs?"
        };
    </script>

    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

@else
    <script type="text/javascript" src="https://chatterpal.me/build/js/chatpal.js?8.3"
        integrity="sha384-+YIWcPZjPZYuhrEm13vJJg76TIO/g7y5B14VE35zhQdrojfD9dPemo7q6vnH44FR" crossorigin="anonymous"
        data-cfasync="false"></script>
    <script>
        var chatPal = new ChatPal({
            embedId: 'RWvE8Za29KJL',
            remoteBaseUrl: 'https://chatterpal.me/',
            version: '8.3'
        });
    </script>
@endif


<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>

</html>
