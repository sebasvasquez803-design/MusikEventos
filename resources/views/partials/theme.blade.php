<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-theme" content="{{ auth()->user()?->theme ?? '' }}">
@auth
    <meta name="theme-update-url" content="{{ route('preferences.theme.update') }}">
@endauth

@php
    $hasViteAssets = file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'));
@endphp

@if ($hasViteAssets)
    @vite(['resources/css/theme.css', 'resources/js/theme.js'])
@endif
