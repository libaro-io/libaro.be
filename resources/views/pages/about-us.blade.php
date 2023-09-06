<x-layout>
    @section('title', page_title(__('about.title')))

    <div class="relative hidden max:block">
        <img class="absolute w-full h-full object-cover inset-0" src="{{ asset("/storage/images/team.jpg") }}"
             alt="Het Libaro team"/>
        <div class="absolute w-full h-full inset-0 bg-white bg-opacity-80 backdrop-filter backdrop-blur-sm"></div>
        <div class="relative lg:max-w-8xl mx-auto">
            <x-nav-bottom :nav="true"/>
            <x-header-single-column
                :dark=false
                title="{{ __('about.title') }}"
                body="{{ __('about.intro') }}"/>
        </div>
    </div>

    <div x-data="{ show: false }"
         class="relative max:hidden">
        <x-header-hamburger :dark="true"/>

        <img class="absolute w-full h-full object-cover inset-0" src="{{ asset("/storage/images/team.jpg") }}"
             alt="Het Libaro team"/>
        <div class="absolute w-full h-full inset-0 bg-white bg-opacity-60 backdrop-filter backdrop-blur-sm"></div>
        <div class="relative lg:max-w-8xl mx-auto">
            <x-header-single-column
                :dark=false
                title="{{ __('about.title') }}"
                body="{{ __('about.intro') }}"/>
        </div>
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

    <x-2column-text-image
        subtitle="{{ __('about.kick-off.subtitle') }}"
        title="{{ __('about.kick-off.title') }}"
        image="{{ asset('storage/images/team_4.jpg') }}">
        <div>
            {!!  __('about.kick-off.body')  !!}
        </div>
    </x-2column-text-image>

    <x-2column-text-image
        :reverse=true
        subtitle="{{ __('about.team.subtitle') }}"
        title=" {{ __('about.team.title') }}"
        image="{{ asset('storage/images/team.jpg') }}">
        <div>
            {{ __('about.team.body') }}
        </div>
    </x-2column-text-image>

    <x-2column-text-image
        subtitle=" {{ __('about.open-source.subtitle') }}"
        title=" {{ __('about.open-source.title') }}"
        image="{{ asset('storage/images/team_10.jpg') }}">
        <div>
            {{ __('about.open-source.body') }}<br />
            <a href="https://github.com/libaro-io" target="_blank">{{ __('general.our') }} GitHub <i class="fab fa-github"></i>  account.</a>
        </div>
    </x-2column-text-image>

    <x-2column-text-image
        :reverse=true
        subtitle=" {{ __('about.ai.subtitle') }}"
        title=" {{ __('about.ai.title') }}"
        image="{{ asset('storage/images/team_3.jpg') }}">
        <div>
            {!!  __('about.ai.body')  !!}
        </div>
    </x-2column-text-image>

    <div class="flex flex-col space-y-4 pb-12 xl:max-w-8xl mx-auto">
        <div class="rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark">
            <img class="object-cover h-full w-full overflow-hidden rounded-inner"
                 src="{{ asset('storage/images/team_5.jpg') }}" alt="Ons Team">
        </div>
        <div class="rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark">
            <img class="object-cover h-full w-full overflow-hidden rounded-inner"
                 src="{{ asset('storage/images/team_2.jpg') }}" alt="Ons Team">
        </div>
        <div class="rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark">
            <img class="object-cover h-full w-full overflow-hidden rounded-inner"
                 src="{{ asset('storage/images/team_6.jpg') }}" alt="Ons Team">
        </div>
        <div class="rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark">
            <img class="object-cover h-full w-full overflow-hidden rounded-inner"
                 src="{{ asset('storage/images/team_7.jpg') }}" alt="Ons Team">
        </div>
        <div class="rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark">
            <img class="object-cover h-full w-full overflow-hidden rounded-inner"
                 src="{{ asset('storage/images/team_8.jpg') }}" alt="Ons Team">
        </div>
        <div class="rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark">
            <img class="object-cover h-full w-full overflow-hidden rounded-inner"
                 src="{{ asset('storage/images/team_9.jpg') }}" alt="Ons Team">
        </div>
    </div>

    <x-cta-contact-us/>

    <x-nav-bottom/>

    <x-footer/>

</x-layout>
