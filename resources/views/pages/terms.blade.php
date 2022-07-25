<x-layout>
    @section('title', page_title(__('general-terms.title')))

    <div class="hidden lg:block">
        <div class="lg:max-w-8xl mx-auto">
            <x-nav-bottom :nav="true"/>
        </div>
    </div>

    <div x-data="{ show: false }"
         class="relative lg:hidden">
        <div @click="show = ! show" class="z-50 absolute top-0 right-0 p-6 cursor-pointer"
             :class="show ? 'text-white' : 'text-primary-dark'">
            <x-svg.menu/>
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

    <main class="max:max-w-8xl px-6 max:px-0 mx-auto font-grotesk font-semibold text-primary-dark prosex text-primary-dark pt-32 lg:pt-0 mb-8">

        <h1 class="mx-auto block font-grotesk font-bold text-7xl text-primary-darkest mb-12">{{ __('general-terms.title') }}</h1>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.general.title') }}</h3>
        <p>{{ __('general-terms.general.body_1') }}</p>
        <p>{{ __('general-terms.general.body_2') }}</p>
        <p>{{ __('general-terms.general.body_3') }}</p>
        <p>{{ __('general-terms.general.body_4') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.purpose-and-content.title') }}</h3>
        <p>{{ __('general-terms.purpose-and-content.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.usage-of-site.title') }}</h3>
        <p>{{ __('general-terms.usage-of-site.body_1') }}</p>
        <p>{{ __('general-terms.usage-of-site.body_2') }}</p>
        <p>{{ __('general-terms.usage-of-site.body_3') }}</p>

        <ul class="list-disc list-inside">
            <li>{{ __('general-terms.usage-of-site.list_1') }}</li>
            <li>{{ __('general-terms.usage-of-site.list_2') }}</li>
            <li>{{ __('general-terms.usage-of-site.list_3') }}</li>
            <li>{{ __('general-terms.usage-of-site.list_4') }}</li>
            <li>{{ __('general-terms.usage-of-site.list_5') }}</li>
            <li>{{ __('general-terms.usage-of-site.list_6') }}</li>
        </ul>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.disclaimer.title') }}</h3>
        <p>{{ __('general-terms.disclaimer.body_1') }}</p>
        <p>{{ __('general-terms.disclaimer.body_2') }}</p>
        <p>{{ __('general-terms.disclaimer.body_3') }}</p>
        <p>{{ __('general-terms.disclaimer.body_4') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.accounts.title') }}</h3>
        <p>{{ __('general-terms.accounts.body_1') }}</p>
        <p>{{ __('general-terms.accounts.body_2') }}</p>
        <p>{{ __('general-terms.accounts.body_3') }}</p>
        <p>{{ __('general-terms.accounts.body_4') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.intellectual-property.title') }}</h3>
        <p>{{ __('general-terms.intellectual-property.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.communication.title') }}</h3>
        <p>{{ __('general-terms.communication.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('general-terms.amendments.title') }}</h3>
        <p>{{ __('general-terms.amendments.body_1') }}</p>
        <p>{{ __('general-terms.amendments.body_2') }}</p>
        <p>{{ __('general-terms.amendments.body_3') }}</p>
        <p>{{ __('general-terms.amendments.body_4') }}</p>
    </main>

    <x-footer/>
</x-layout>
