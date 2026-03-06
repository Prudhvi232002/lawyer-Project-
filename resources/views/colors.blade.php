@php
    $primary_color = App\Models\ThemeSetting::where('color', 'primary_color')->whereNot('theme_code','default')->active()->first();
    $secondary_color = App\Models\ThemeSetting::where('color', 'secondary_color')->whereNot('theme_code','default')->active()->first();
    $tertiary_color = App\Models\ThemeSetting::where('color', 'tertiary_color')->whereNot('theme_code','default')->active()->first();
    // $tertiary_color = App\Models\ThemeSetting::where('color', 'tertiary_color')->whereNot('theme_code','default')->active()->first();
    // dd($primary_color);
@endphp
<style>
:root {
    /* Dynamic Colors */
    --primary-color: #fdc324;   /* Fallback primary color */
    --secondary-color: #6c757d; /* Fallback secondary color */
    --tertiary-color: #957C3D;
    --success-color: #198754;   /* Fallback success color */
    --danger-color: #dc3545;    /* Fallback danger color */
    --info-color: #17a2b8;      /* Info color */
    --warning-color: #ffc107;   /* Warning color */
    --light-color: #f8f9fa;     /* Light color */
    --dark-color: #343a40;
    --text-white: #ffffff;        /* Dark color */
    @php
        $primary_color_rgb = hexToRgb($primary_color && $primary_color->value ? $primary_color->value : '#cab083');
        $secondary_color_rgb = hexToRgb($secondary_color && $secondary_color->value ? $secondary_color->value : '#262929');
        /* $secondary_color_rgb = "255, 255, 255"; */
        $primary_color = $primary_color && $primary_color->value ? $primary_color->value : '#cab083';
        $secondary_color = $secondary_color && $secondary_color->value ? $secondary_color->value : '#262929';
        $tertiary_color = $tertiary_color && $tertiary_color->value ? $tertiary_color->value : '#FCECCB;';

        /* dd($secondary_color_rgb) */

    @endphp
    /* Bootstrap Specific Variables */
    --bs-primary: {{ $primary_color }};
    --bs-secondary: {{ $secondary_color }};
    --tertiary-color: {{ $tertiary_color}};
    --bs-primary-rgb: {{ $primary_color_rgb }};
    --bs-secondary-rgb: {{ $secondary_color_rgb }};
    --bs-secondary: {{ $secondary_color }};
    --bs-success: var(--success-color);
    --bs-danger: var(--danger-color);
    --bs-info: var(--info-color);
    --bs-warning: var(--warning-color);
    --bs-light: var(--light-color);
    --bs-dark: var(--dark-color);

    --bs-nav-pills-link-active-bg: var(--primary-color);
/* --bs-link-hover-color-rgb: {{ $secondary_color }}; */
    /* Similarly for other variables... */
}
</style>
