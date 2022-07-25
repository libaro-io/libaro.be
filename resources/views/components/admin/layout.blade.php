<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <title>{{ config('app.name') }}</title>
</head>
<body class="antialiased">

    <div class="flex flex-col">
        <x-admin.nav />

        <x-admin.header :title="$title" />

        <main class="min-h-screen bg-gray-100">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>

            <x-admin.flash />
        </main>

    </div>

</body>
</html>

