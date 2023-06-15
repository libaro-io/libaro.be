<x-layout>
    @push('head')
        <style>
            .app {
                height: 100vh;
                width: 100%;
            }
        </style>
        <script src="{{ mix('/js/playground/logo-3d.js') }}" defer></script>
    @endpush

    @section('title', page_title('3D Logo'))

    <main class="app" style="background-image: url('/storage/images/header_striped.jpg'); background-size: cover;">
        <canvas></canvas>
    </main>
</x-layout>
