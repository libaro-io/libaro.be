<x-layout>
    @section('title', page_title(__('expertise.title')))

    <div class="hidden max:block border-b-10 border-secondary"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">

        <div class="max:max-w-8xl mx-auto">
            <div class="hidden max:block">
                <x-nav/>

            </div>
            <div class="pt-24">
                <x-header-single-column title="{{ __('expertise.title') }}"
                                        subtitle="{{ __('expertise.subtitle') }}"/>
            </div>
        </div>
    </div>

    <div x-data="{ show: false }" class="max:hidden relative">
        <div
            style="background-image: url('{{ asset('/storage/images/header_bg.png') }}'); background-repeat: no-repeat; background-size: cover">
            <div class="relative max:max-w-8xl mx-auto">
                <x-header-single-column title="{{ __('expertise.title') }}"
                                        subtitle="{{ __('expertise.subtitle') }}"/>
            </div>
        </div>
        <x-header-hamburger/>

        <div x-show="show"
             x-transition:enter="transition transform duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="z-30 bg-primary-dark fixed top-0 left-0 min-h-screen w-screen">
            <x-nav-full-screen/>
        </div>
    </div>

    <main class="md:mt-24">
        <section class="max-w-8xl mx-auto md:mb-24">

            <a href="{{ route('our-expertise.webontwikkeling') }}"
               class="block cursor-pointer p-4 hover:bg-primary-light">

                <x-key number="1"
                       title="{{ __('expertise.web.title') }}"
                       body="{{ __('expertise.web.body') }}"/>
            </a>

            <a href="{{ route('our-expertise.artificial-intelligence') }}"
               class="block cursor-pointer p-4 hover:bg-primary-light">

                <x-key number="2"
                       title="{{ __('expertise.ai.title') }}"
                       body="{{ __('expertise.ai.body') }}"/>

            </a>

            <a href="{{ route('our-expertise.apps') }}"
               class="block cursor-pointer p-4 hover:bg-primary-light">

                <x-key number="3"
                       title="{{ __('expertise.apps.title') }}"
                       body="{{ __('expertise.apps.body') }}"/>
            </a>

            <a href="{{ route('our-expertise.iot') }}"
               class="block cursor-pointer p-4 hover:bg-primary-light">

                <x-key number="4"
                       title="{{ __('expertise.iot.title') }}"
                       body="{{ __('expertise.iot.body') }}"/>
            </a>

        </section>

        <section class="max-w-8xl mx-auto md:mb-24 p-4">
            <x-expertise.tech-stack/>
        </section>
    </main>

    <x-cta-contact-us/>

    <x-nav-bottom/>

    <x-footer/>

</x-layout>
