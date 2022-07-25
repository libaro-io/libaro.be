<x-layout>
    @section('title', page_title(__('expertise.title')))

    <div class="hidden max:block border-b-10 border-secondary"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">

        <div class="max:max-w-8xl mx-auto">
            <div class="hidden max:block">
                <x-nav/>

            </div>
            <div class="pt-24">
                <x-header-single-column title="{{ __('expertise.architecture.title') }}"
                                        subtitle="{{ __('expertise.title') }}"/>
            </div>
        </div>
    </div>

    <div x-data="{ show: false }" class="max:hidden relative">
        <div
            style="background-image: url('{{ asset('/storage/images/header_bg.png') }}'); background-repeat: no-repeat; background-size: cover">
            <div class="relative max:max-w-8xl mx-auto">
                <x-header-single-column title="{{ __('expertise.architecture.title') }}"
                                        subtitle="{{ __('expertise.title') }}"/>
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

    <main class="max:mt-24">
        <section class="max-w-8xl mx-auto px-4 max:px-0 pb-8 max:pb-24">
            <div class="mt-8 mb-12 leading-relaxed">
                <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">
                    {{ __('expertise.architecture.page.intro') }}
                </p>
            </div>

            <div class="mt-8 mb-12 leading-relaxed">
                <h3 class="font-gilroy font-extrabold text-2xl lg:text-4xl text-primary-darkest mb-4">
                    {{ __('expertise.architecture.page.offer.title') }}
                </h3>
                <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">
                    {{ __('expertise.architecture.page.offer.body') }}
                </p>
            </div>

            <div class="mt-8 mb-12 leading-relaxed">
                <h3 class="font-gilroy font-extrabold text-2xl lg:text-4xl text-primary-darkest mb-4">
                    {{ __('expertise.architecture.page.analysis.title') }}
                </h3>
                <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">
                    {{ __('expertise.architecture.page.analysis.body') }}
                </p>
            </div>

            <div class="mt-8 mb-12 leading-relaxed">
                <h3 class="font-gilroy font-extrabold text-2xl lg:text-4xl text-primary-darkest mb-4">
                    {{ __('expertise.architecture.page.competitive-analysis.title') }}
                </h3>
                <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">
                    {{ __('expertise.architecture.page.competitive-analysis.body') }}
                </p>
            </div>
        </section>

        <section class="bg-primary-light border-b-20 border-project-border mt-32 md:mt-64 lg:mt-470">
            <div class="max-w-8xl mx-auto p-4 lg:p-0">
                <div
                    class="md:border-2 border-grey-dark rounded-outer overflow-hidden md:p-5 bg-grey-light transform -translate-y-1/3">
                    <img class="rounded-inner overflow-hidden w-full lg:h-620 object-cover object-top"
                         src='{{ asset("/storage/images/team_13.jpg") }}' alt="team pic">
                </div>
            </div>
        </section>
    </main>

    <x-cta-contact-us/>

    <x-nav-bottom/>

    <x-footer/>

</x-layout>
