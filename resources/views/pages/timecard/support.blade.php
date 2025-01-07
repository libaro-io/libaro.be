<x-layout>
    @section('title', 'Supportpagina Robaws')
    <div class="hidden max:block border-b-10 border-secondary"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">

        <div class="max:max-w-8xl mx-auto">
            <div class="hidden max:block">
                <x-nav/>

            </div>
            <div class="pt-24">
                <x-header-single-column title="Supportpagina Robaws"
                                        subtitle="Hoe kunnen wij u helpen?"/>
            </div>
        </div>
    </div>

    <div x-data="{ show: false }" class="max:hidden relative">
        <div
            style="background-image: url('{{ asset('/storage/images/header_bg.png') }}'); background-repeat: no-repeat; background-size: cover">
            <div class="relative max:max-w-8xl mx-auto">
                <x-header-single-column title="Supportpagina Robaws"
                                        subtitle="Hoe kunnen wij u helpen?"/>
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
        <section class="max-w-8xl mx-auto md:mb-24 p-4">
            <div class="documentation-download mb-12">
                <h1 class="font-gilroy font-bold text-5xl text-primary-darkest mb-5">{{ __('Documentatie') }}</h1>
                <a href="https://docs.google.com/document/u/0/d/1s5Svw9ffZtxFpLzbvqRdkBwkB3X04SZQ7JVPh92rJ1s/edit"
                   class="cursor-pointer text-primary-dark font-gilroy hover:text-secondary transition-colors">
                    <span>
                        Handleiding
                    </span>
                    <i class="fas fa-download"></i>
                </a>
            </div>
            <div class="faq mb-12">

                <h1 class="font-gilroy font-bold text-5xl text-primary-darkest mb-5">{{ __('FAQ') }}</h1>
                <div
                    class="flex flex-col gap-4">
                    @foreach($faqs as $faq)
                        <div
                            x-data="{ open: false }"
                            class="faq-item p-2 md:p-4 bg-primary-light text-primary-darkest">
                            <div
                                @click="open = !open"
                                class="flex justify-between items-center gap-4 text-primary-dark font-gilroy font-bold text-2xl cursor-pointer">
                                <h3>
                                    {{ $faq['question'] }}
                                </h3>
                                <i x-show="!open" class="fas fa-chevron-down text-primary-dark text-base"></i>
                                <i x-show="open" class="fas fa-chevron-up text-primary-dark text-base"></i>
                            </div>
                            <p
                                x-transition:enter="h-0 opacity-0"
                                x-transition:enter-start="h-0 opacity-0"
                                x-transition:enter-end="h-auto opacity-100"
                                x-transition:leave="h-auto opacity-100"
                                x-transition:leave-start="h-auto opacity-100"
                                x-transition:leave-end="h-0 opacity-0"
                                x-show="open"
                                class="text-primary-darkest mt-2">
                                {{ $faq["answer"] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="installation instructions mb-12">
                <h1 class="font-gilroy font-bold text-5xl text-primary-darkest mb-5">{{ __('Installatie instructies') }}</h1>
                <p class="font-grotesk font-semibold text-xl text-primary-darkest">{{ __('Instructies voor het installeren van een PWA (Progressive Web App) op iOS en Android toestellen.') }}</p>
                <div class="ios my-5">
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-center">
                        <div class="col-span-5">

                            <h2 class="font-gilroy font-bold text-3xl text-primary-darkest mt-5 mb-3">iOS</h2>
                            <ol class="list-decimal list-inside">
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Stap 1: Open
                                    Safari op je iPhone.
                                </li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Navigeer naar
                                    <a href="https://timecard.libaro.io/">https://timecard.libaro.io/</a> in de
                                    adresbalk van Safari.
                                </li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Tik op het
                                    'Delen'-icoon (vierkant met een pijl omhoog) onderaan het scherm.
                                </li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">In het geopende
                                    menu scroll je naar beneden en tik je op 'Zet op beginscherm'.
                                </li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Tik op 'Voeg
                                    toe' in de rechterbovenhoek van het scherm.
                                </li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">De app wordt nu
                                    toegevoegd aan het beginscherm van je iPhone. Je kan de app openen door op het
                                    nieuwe icoon te tikken.
                                </li>
                            </ol>
                        </div>
                        <div>
                            <img src="{{ asset('images/timecart/ios.png') }}" alt="iOS installatie"
                                 class="w-full h-auto">
                        </div>
                    </div>
                </div>
                <div class="android my-5">
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-center">
                        <div class="col-span-5">
                            <h2 class="font-gilroy font-bold text-3xl text-primary-darkest mt-5 mb-3">Android</h2>
                            <ol class="list-decimal list-inside">
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Stap 1: Open Google Chrome op je Android-toestel.</li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Navigeer naar
                                    <a href="https://timecard.libaro.io/">https://timecard.libaro.io/</a> in de adresbalk van Chrome.</li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Tik op het menu-icoon (drie verticale stipjes) rechtsboven in het scherm.</li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">In het geopende menu tik je op 'Toevoegen aan startscherm' of 'App installeren' (afhankelijk van je Android-versie).</li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">Pas indien gewenst de naam van de app aan en tik op 'Toevoegen' of 'Installeren' om de PWA aan je startscherm toe te voegen.</li>
                                <li class="mb-2 font-grotesk font-semibold text-xl text-primary-darkest">De PWA wordt nu toegevoegd aan het startscherm van je Android-toestel. Je kan de app openen door op het nieuwe icoon te tikken.</li>
                            </ol>
                        </div>
                        <div>
                            <img src="{{ asset('images/timecart/android.jpg') }}" alt="Android installatie"
                                 class="w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="questions my-24">
                <h1 class="font-gilroy font-bold text-5xl text-primary-darkest mb-5">{{ __('Heeft u verdere vragen of ondersteuning nodig?') }}</h1>
                <p class="font-grotesk font-semibold text-xl text-primary-darkest">{{ __(' Ons team staat klaar om u te helpen!') }}</p>
                <div class="email">
                    <a href="mailto:info@libaro.be"
                       class="cursor-pointer text-primary-dark font-gilroy hover:text-secondary transition-colors text-xl inline-flex items-center gap-2 mt-4">

                        <i class="fas fa-envelope"></i>
                        <span>
                            info@libaro.be
                        </span>
                    </a>
                    <div class="availble-at">
                        <p class="font-grotesk font-semibold text-primary-darkest mt-4">{{ __('Wij zijn beschikbaar maandag tot vrijdag van 09:00 tot 17:00 uur') }}</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-footer/>
</x-layout>
