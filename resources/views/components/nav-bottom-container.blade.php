@props(['dark' => false])

<div class="hidden max:block">
    <div class="xl:max-w-8xl mx-auto">
        <x-nav-bottom :nav="true"/>
    </div>
</div>

<div x-data="{ show: false }"
     class="relative max:hidden">
    <x-header-hamburger :dark="$dark"/>

    <div x-show="show"
         x-transition:enter="transition transform duration-1000"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="z-50 bg-primary-dark fixed top-0 left-0 min-h-screen w-screen">
        <x-nav-full-screen/>
    </div>
</div>
