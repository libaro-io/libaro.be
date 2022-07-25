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
<body class="antialiased bg-gray-50">

    <main class="max-w-7xl mx-auto">
        {{ $slot }}
    </main>

</body>
</html>

