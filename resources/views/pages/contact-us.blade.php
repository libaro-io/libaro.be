<x-layout>
    @section('title', page_title('Contact'))

    <div class="hidden max:block border-b-10 border-secondary"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">
        <div class="max:max-w-8xl mx-auto">
            <div class="hidden max:block">
                <x-nav />

            </div>
            <div class="pt-24">
                <x-header-single-column title="{{ __('contact.title') }}"
                                        subtitle="{{ __('contact.subtitle') }}"
                />
            </div>
        </div>
    </div>

    <div x-data="{ show: false }" class="max:hidden relative">
        <div style="background-image: url('{{ asset('/storage/images/header_bg.png') }}'); background-repeat: no-repeat; background-size: cover">
            <div class="relative max:max-w-8xl mx-auto">
                <x-header-single-column title="{{ __('contact.title') }}"
                                        subtitle="{{ __('contact.subtitle') }}"
                />
            </div>
        </div>
        <x-header-hamburger :dark=false />
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

    <main class="lg:mt-24">
        <section>
            <div class="max-w-8xl mx-auto max:px-0 max:mt-0">
                <div class="grid grid-cols-4">
                    <div class="col-span-4 lg:col-span-2 mx-10 mt-10 lg:mt-0">
                        <div class="flex flex-col bg-white md:bg-primary-light md:p-8">
                            <div class="flex items-center">
                                <div class="relative w-16 h-16 mr-4">
                                    <img class="rounded-full w-16 h-16" src="{{ asset('storage/images/bert.jpg') }}" alt="Image of Bert" />
                                    <div class="absolute bottom-0 right-0 mr-1 w-3 h-3 rounded-full bg-green-500 border-2 border-white"></div>
                                </div>
                                <div class="mt-2 mb-4 md:mb-0 text-primary-dark font-grotesk text-lg mb-2 flex flex-col justify-between">
                                    <div class="font-bold">Bert Clybouw</div>
                                    <a href="mailto:bert@libaro.be">bert@libaro.be</a>
                                    <div class="text-primary-dark font-grotesk text-lg">+32 (0)494 207025</div>
                                </div>
                            </div>

                            <div class="text-primary-dark font-grotesk text-lg mb-2 mt-2">Vaartdijkstraat 19, 8200 {{ __('general.brugge') }}<br />
                                {{ __('general.belgium') }}</div>
                        </div>
                    </div>
                    <div class="col-span-4 lg:col-span-2 my-10 lg:my-0 mx-10">
                        <x-forms.contact />
                    </div>
                </div>
            </div>
            <div class="lg:pt-28">
                <x-callout
                    image="{{ asset('/storage/images/strategy_2.jpg') }}"
                    altText="Image">
                    <p class="text-center">{{ __('contact.callout-message') }}</p>
                </x-callout>
            </div>

        </section>
    </main>

    <x-nav-bottom />

    <x-footer />

</x-layout>
