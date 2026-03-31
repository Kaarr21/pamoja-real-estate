<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->site_name ?? config('app.name', 'Pamoja Real Estate') }} - @yield('title', 'Luxury Living')</title>

    <!-- Meta Tags for SEO -->
    <meta name="description" content="@yield('meta_description', $settings->meta_description ?? 'Discover premium properties with Pamoja Real Estate. Your gateway to luxury living.')">
    <meta property="og:title" content="{{ $settings->site_name ?? config('app.name', 'Pamoja Real Estate') }}">
    <meta property="og:description" content="{{ $settings->meta_description ?? 'Discover premium properties with Pamoja Real Estate.' }}">
    <meta property="og:type" content="website">

    <!-- Montserrat font as fallback, though app.css loads Inter and Noto Serif -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <div class="container nav">
            <a href="/" class="logo">{{ $settings->logo_text ?? 'PAMOJA' }}</a>
            <nav class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                <a href="/team" class="{{ request()->is('team') ? 'active' : '' }}">Team</a>
                @auth
                    <a href="/admin">Dashboard</a>
                @else
                    <a href="/admin/login">Agent Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ $settings->site_name ?? 'Pamoja Real Estate' }}. All rights reserved.</p>
            <p style="margin-top: 1rem; color: var(--text-muted);">{{ $settings->footer_copy ?? 'Crafted for Luxury & Excellence' }}</p>
        </div>
    </footer>
</body>
</html>
