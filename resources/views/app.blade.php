<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Inline script to detect system dark mode preference and apply it immediately --}}
    <script>
        (function() {
            const appearance = '{{ $appearance ?? "system" }}';

            if (appearance === 'system') {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (prefersDark) {
                    document.documentElement.classList.add('dark');
                }
            }
        })();
    </script>

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#0091ff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#0091ff">

    <meta name="description"
          content="Wij zetten ideeën om in sterke en stijlvolle webapplicaties. Met onze state-of-the-art webapplicaties en onze persoonlijke aanpak veroveren samen het web.">

    <meta property="twitter:title" content="Innovatieve webapplicaties & stijlvolle websites | Libaro">
    <meta property="twitter:description"
          content="Wij zetten ideeën om in sterke en stijlvolle webapplicaties. Met onze state-of-the-art webapplicaties en onze persoonlijke aanpak veroveren samen het web.">
    <meta property="twitter:image" content="{{ asset('storage/images/libaro_icon.png') }}">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:site" content="@libarosoftware">
    <meta property="twitter:url" content="https://libaro.be/nl">

    <meta property="og:title" content="Innovatieve webapplicaties & stijlvolle websites | Libaro">
    <meta property="og:description"
          content="Wij zetten ideeën om in sterke en stijlvolle webapplicaties. Met onze state-of-the-art webapplicaties en onze persoonlijke aanpak veroveren samen het web.">
    <meta property="og:image" content="{{ asset('storage/images/og_image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Libaro">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://libaro.be/nl">
    <meta property="fb:app_id" content="337068846453413">

    @vite(['resources/js/app.ts'])
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
<script defer async src="https://kit.fontawesome.com/0ec3ed4413.js" crossorigin="anonymous"></script>
</body>
</html>
