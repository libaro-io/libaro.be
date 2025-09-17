<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="{{ asset('storage/favicon/manifest.json') }}">
    <link rel="shortcut icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('storage/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('storage/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('storage/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('storage/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('storage/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('storage/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('storage/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('storage/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('storage/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('storage/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/favicon/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#0091ff">
    <meta name="msapplication-TileImage" content="{{ asset('storage/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#0091ff">

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('./service-worker.js')
            .then(function(registration) {
                // Registration was successful
            }).catch(function(err) {
                // registration failed :(
            });
        }
    </script>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <title>@yield('title', config('app.name'))</title>

    <meta http-equiv="refresh" content="300">
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

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PZW6PW');</script>
    <!-- End Google Tag Manager -->
    <script type="application/ld+json">
		{ "@context" : "https://schema.org",
		  "@type" : "Organization",
		  "name" : "Libaro",
		  "url" : "//libaro.be",
		  "sameAs" : [ "https://www.facebook.com/libaro1",
		    "https://www.twitter.com/libarosoftware",
		    "https://www.linkedin.com/company/libaro"]
		}

    </script>

    {!! htmlScriptTagJsApi([
        'lang' => 'nl',
        ])
    !!}

    @stack('head')

    @livewireStyles
</head>
<body class="antialiased">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PZW6PW"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
{{ $slot }}

<x-admin.flash/>

@include('cookie-consent::index')

@livewireScripts
</body>
</html>
