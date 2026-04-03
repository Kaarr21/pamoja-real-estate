<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->site_name ?? config('app.name', 'Pamoja Real Estate') }} - @yield('title', 'Luxury Living')
    </title>

    <!-- Meta Tags for SEO -->
    <meta name="description"
        content="@yield('meta_description', $settings->meta_description ?? 'Discover premium properties with Pamoja Real Estate. Your gateway to luxury living.')">
    <meta property="og:title" content="{{ $settings->site_name ?? config('app.name', 'Pamoja Real Estate') }}">
    <meta property="og:description"
        content="{{ $settings->meta_description ?? 'Discover premium properties with Pamoja Real Estate.' }}">
    <meta property="og:type" content="website">

    <!-- Montserrat font as fallback, though app.css loads Inter and Noto Serif -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', scrolled: false }" :class="{ 'dark': darkMode }"
    @scroll.window="scrolled = (window.pageYOffset > 50)">

    <header :class="{ 'glass scrolled': scrolled, 'glass': !scrolled }">
        <div class="container nav-content">
            <a href="/" class="logo">{{ $settings->logo_text ?? 'PAMOJA' }}</a>

            <nav class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                <a href="/team" class="{{ request()->is('team') ? 'active' : '' }}">Team</a>

                <div
                    style="display: flex; align-items: center; gap: 1.5rem; margin-left: 1rem; border-left: 1px solid hsla(var(--border) / 0.5); padding-left: 1.5rem;">
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="dark-mode-toggle"
                        style="background: none; border: none; cursor: pointer; color: hsl(var(--primary)); display: flex; align-items: center;">
                        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                        <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </button>

                    @auth
                        <a href="/admin" class="btn btn-primary"
                            style="padding: 0.5rem 1.25rem; font-size: 0.75rem;">Dashboard</a>
                    @else
                        <a href="/admin/login" class="btn btn-outline"
                            style="padding: 0.5rem 1.25rem; font-size: 0.75rem;">Login</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 4rem; text-align: left;">
            <div>
                <a href="/" class="logo"
                    style="margin-bottom: 1.5rem; display: block;">{{ $settings->logo_text ?? 'PAMOJA' }}</a>
                <p style="color: hsl(var(--text-muted)); max-width: 300px; margin-bottom: 2rem;">
                    {{ $settings->hero_subtitle ?? 'Premium real estate curated for excellence. Find your next masterpiece with Pamoja.' }}
                </p>
                <div style="display: flex; gap: 1rem;">
                    <!-- Social icons could go here -->
                </div>
            </div>
            <div>
                <h4
                    style="margin-bottom: 1.5rem; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; color: hsl(var(--primary));">
                    Quick Links</h4>
                <ul style="display: grid; gap: 0.75rem; color: hsl(var(--text-muted)); font-size: 0.9rem;">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/team">Curators</a></li>
                    <li><a href="/admin/login">Agent Portal</a></li>
                </ul>
            </div>
            <div>
                <h4
                    style="margin-bottom: 1.5rem; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; color: hsl(var(--primary));">
                    Contact</h4>
                <p style="color: hsl(var(--text-muted)); font-size: 0.9rem; line-height: 1.8;">
                    {{ $settings->contact_email ?? 'concierge@pamoja.com' }}<br>
                    {{ $settings->contact_phone ?? '+254 700 000 000' }}
                </p>
            </div>
        </div>
        <div class="container"
            style="margin-top: 5rem; pt: 2rem; border-top: 1px solid hsla(var(--border) / 0.5); text-align: center;">
            <p style="color: hsl(var(--text-muted)); font-size: 0.8rem;">
                &copy; {{ date('Y') }} {{ $settings->site_name ?? 'Pamoja Real Estate' }}. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Alpine.js for interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>