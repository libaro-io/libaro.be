<x-layout>
    @section('title', page_title(__('privacy.title')))

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
        <h1 class="mx-auto block font-grotesk font-bold text-7xl text-primary-darkest mb-12">{{ __('privacy.title') }}</h1>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.general.title') }}</h3>
        <p>{{ __('privacy.general.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.personal-info.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.personal-info.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.personal-info-processing-why.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.personal-info-processing-why.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.processing-service-for-client.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.processing-service-for-client.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.sharing-of-personal-info.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.sharing-of-personal-info.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.securing-personal-info.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.securing-personal-info.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.duration-of-storage.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.duration-of-storage.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.rights.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.rights.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.changes.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.changes.body') }}</p>

        <h3 class="font-bold text-primary-darkest text-3xl mt-8 mb-2">{{ __('privacy.questions-and-complaints.title') }}</h3>
        <p class="leading-relaxed">{{ __('privacy.questions-and-complaints.body') }}</p>
    </main>

    <x-footer/>
</x-layout>
