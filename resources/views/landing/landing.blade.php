<x-layout>

    @section('title', page_title('Data-driven web applications'))

    <div class="hidden max:block border-b-10 border-secondary h-920"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">
        <div class="max:max-w-8xl mx-auto">
            <x-nav/>
            <div class="grid grid-cols-24 gap-y-10 max:gap-y-0 max:gap-x-10 pt-12 lg:pt-28 max:pt-0">
                <div class="col-span-24 lg:col-span-13 flex flex-col mt-16 px-6 max:px-0">
                    <h1 class="text-xl font-gilroy font-bold leading-snug md:text-5xl max:leading-snug max:text-7xl text-white">{{ $landingPage->title}}</h1>

                    <p class="font-grotesk font-semibold text-base md:text-2xl mt-4 md:mt-10 lg:pb-20 max:pb-0 text-white md:leading-9">
                        {{ __("general.about-us") }}
                    </p>
                </div>

                <div class="col-span-24 lg:col-span-11 lg:mt-20x max:mt-0">
                    <img class="mx-auto object-cover w-64 lg:w-1/2 max:w-screen
                        transform transition ease-in-out duration-300 hover:rotate-12 hover:scale-95"
                         src="{{ asset('/storage/images/clock_side.png') }}" alt="Clock">
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ show: false }" class="relative max:hidden"
         style="background-image: url('{{ asset('/storage/images/header_bg.png') }}')">
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
        <div class="grid grid-cols-24 gap-y-10 max:gap-y-0 max:gap-x-10 pt-12 max:pt-0">
            <div class="col-span-24 md:col-span-13 flex flex-col mt-16 md:mb-16 lg:mb-0 px-6 max:px-0">
                <h2 class="text-xl font-gilroy font-bold leading-snug md:text-5xl max:leading-snug max:text-7.5xl text-white">{{ __("Partner voor digitale innovaties") }}</h2>

                <p class="font-grotesk font-semibold text-base md:text-2xl mt-4 md:mt-10 lg:pb-20 max:pb-0 text-white md:leading-9">
                    {{ __("general.about-us") }}
                </p>
            </div>

            <div class="col-span-24 md:col-span-11 flex items-center md:mt-20x max:mt-0">
                <img class="mx-auto object-cover w-64 lg:w-1/2 max:w-screen
                        transform transition ease-in-out duration-300 hover:rotate-12 hover:scale-95"
                     src="{{ asset('/storage/images/clock_side.png') }}" alt="Clock">
            </div>
        </div>
    </div>
    @if($landingPage->showcases->count())
        <div class="bg-projects-bg border-b-30 border-project-border py-10.5 xl:py-0 xl:h-768">
            <div class="relative max-w-9xl mx-auto">
                <div
                    class="xl:absolute xl:top-0 xl:left-0 xl:bg-white xl:rounded-outer-sm xl:shadow-2xl grid xl:grid-cols-3 gap-10.5 xl:-mt-14 p-7.5">
                    @foreach($landingPage->showcases as $showcase)
                        <x-recent-showcase-card :showcase="$showcase"/>
                    @endforeach

                </div>
            </div>
        </div>
    @endif
    <section class="px-4 max:px-0 lg:max-w-8xl mx-auto bg-white pt-20 pb-28 grid grid-cols-24">
        <div class="col-span-24 lg:col-span-11 mb-10.5 lg:mb-0">
            <x-elements.h3>{{ __('home.expertise.title') }}</x-elements.h3>
            <x-elements.h2>{{$landingPage->text1}}</x-elements.h2>
            <p class="leading-normal font-semibold font-grotesk text-base md:text-paragraph text-primary-darkest">
                {{ $landingPage->text2}}
            </p>
        </div>

        <div
            class="flex col-span-24 lg:col-start-13 lg:col-span-12 rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark">
            <img class="object-cover w-full h-full rounded-inner overflow-hidden"
                 src="{{ asset('/storage/images//landing/team_'.$landingPage->image_index.'.jpg') }}" alt="Strategy">
        </div>
    </section>

    <livewire:our-customers/>

    <x-cta-contact-us/>

    <x-nav-bottom/>

    <x-footer/>

</x-layout>
