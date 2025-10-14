<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Inline script to detect system dark mode preference and apply it immediately --}}
    <script>
        (function () {
            const appearance = '{{ $appearance ?? "system" }}';

            if (appearance === 'system') {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (prefersDark) {
                    document.documentElement.classList.add('dark');
                }
            }
        })();
    </script>

    <title inertia>{{ config('app.name', 'Libaro') }}</title>

    <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

    <meta name="msapplication-TileColor" content="#0091ff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#0091ff">

    <meta property="twitter:image" content="{{ asset('storage/images/libaro_icon.png') }}">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:site" content="@libarosoftware">
    <meta property="twitter:url" content="{{ url()->current() }}">

    <meta property="og:image" content="{{ asset('/images/libaro_social.webp') }}">
    <meta property="og:image:type" content="image/webp"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="fb:app_id" content="337068846453413">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://analytics.libaro.be/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PZW6PW');</script>
    <!-- End Google Tag Manager -->

    <link rel="preconnect" href="https://{{ config('filesystems.disks.s3.bucket') }}.s3.{{ config('filesystems.disks.s3.region') }}.amazonaws.com">

    <link rel="preload" as="image" href="/images/header_striped.webp">
    <link rel="preload" as="image" href="/images/clock_side.webp">

    <link rel="preload" as="font" href="/fonts/gilroy/gilroy_bold.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="/fonts/gilroy/gilroy_extrabold.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="/fonts/grotesk/grotesk_regular.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="/fonts/grotesk/grotesk_medium.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="/fonts/grotesk/grotesk_semibold.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="/fonts/grotesk/grotesk_bold.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="/fonts/grotesk/grotesk_extrabold.woff2" type="font/woff2" crossorigin="anonymous">

    <style>
        @font-face {
            font-family: 'gilroy';
            font-display: swap;
            font-weight: 700;
            src: url('/fonts/gilroy/gilroy_bold.woff2') format('woff2');
        }

        @font-face {
            font-family: 'gilroy';
            font-display: swap;
            font-weight: 800;
            src: url('/fonts/gilroy/gilroy_extrabold.woff2') format('woff2');
        }

        @font-face {
            font-family: 'grotesk';
            font-display: swap;
            font-weight: 400;
            src: url('/fonts/grotesk/grotesk_regular.woff2') format('woff2');
        }

        @font-face {
            font-family: 'grotesk';
            font-display: swap;
            font-weight: 500;
            src: url('/fonts/grotesk/grotesk_medium.woff2') format('woff2');
        }

        @font-face {
            font-family: 'grotesk';
            font-display: swap;
            font-weight: 600;
            src: url('/fonts/grotesk/grotesk_semibold.woff2') format('woff2');
        }

        @font-face {
            font-family: 'grotesk';
            font-display: swap;
            font-weight: 700;
            src: url('/fonts/grotesk/grotesk_bold.woff2') format('woff2');
        }

        @font-face {
            font-family: 'grotesk';
            font-display: swap;
            font-weight: 800;
            src: url('/fonts/grotesk/grotesk_extrabold.woff2') format('woff2');
        }
    </style>

    <link rel="preload" href="//kit.fontawesome.com/0ec3ed4413.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://kit.fontawesome.com/0ec3ed4413.css">
    </noscript>

    @vite(['resources/js/app.ts'])

    @inertiaHead
</head>
<body class="font-sans antialiased">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://analytics.libaro.be/ns.html?id=GTM-PZW6PW"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

@inertia
</body>
</html>
