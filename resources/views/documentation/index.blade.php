<x-layout>

    @section('title', page_title('Data-driven web applications'))

    <div class="hidden max:block border-b-10 border-secondary"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">
        <div class="max:max-w-8xl mx-auto pb-8">
            <x-nav/>
            <div class="grid grid-cols-24 gap-y-10 max:gap-y-0 max:gap-x-10 pt-12 lg:pt-28 max:pt-0">
                <div class="col-span-24 lg:col-span-13 flex flex-col mt-16 px-6 max:px-0">
                    <h2 class="text-xl font-gilroy font-bold leading-snug md:text-5xl max:leading-snug max:text-7.5xl text-white">{{ __("Our open-source packages") }}</h2>

                    <p class="font-grotesk font-semibold text-base md:text-2xl mt-4 md:mt-10 lg:pb-20 max:pb-0 text-white md:leading-9">
                        {{ __("A list of open-source packages we maintain. Click on a package to go the the docs to view full installation and usage information.") }}
                    </p>

                    <div class="flex gap-4 mt-8">
                        <a href="{{ route('docs.show', ['repository' => 'github', 'path' => 'CONTRIBUTING.md']) }}"
                            class="cursor-pointer hover:shadow-md transition-all duration-75 flex items-center text-sm shadow-sm">
                            <span class="rounded-l-md font-semibold px-4 py-1 bg-primary-darkest text-white">Read our</span>
                            <span class=" bg-white rounded-r-md px-4 py-1 text-gray-600">Contribution Guide</span>
                        </a>
                        <a href="{{ route('docs.show', ['repository' => 'github', 'path' => 'DEVELOPMENT_FLOW.md']) }}"
                            class="cursor-pointer hover:shadow-md transition-all duration-75 flex items-center text-sm shadow-sm">
                            <span class="rounded-l-md font-semibold px-4 py-1 bg-primary-darkest text-white">Read our</span>
                            <span class="bg-white rounded-r-md px-4 py-1 text-gray-600">Development Flow Guide</span>
                        </a>
                    </div>
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
            <div class="col-span-24 md:col-span-13 flex flex-col mt-16 md:mb-16 lg:mb-0 px-6 max:px-0 pb-8">
                <h2 class="text-xl font-gilroy font-bold leading-snug md:text-5xl max:leading-snug max:text-7.5xl text-white">{{ __("Our open-source packages") }}</h2>

                <p class="font-grotesk font-semibold text-base md:text-2xl mt-4 md:mt-10 lg:pb-20 max:pb-0 text-white md:leading-9">
                    {{ __("A list of open-source packages we maintain. Click on a package to go the the docs to view full installation and usage information.") }}
                </p>

                <div class="flex flex-col gap-4 mt-8">
                    <a href="{{ route('docs.show', ['repository' => 'github', 'path' => 'CONTRIBUTING.md']) }}"
                       class="max-w-max rounded-md overflow-hidden cursor-pointer hover:shadow-md transition-all duration-75 flex items-center text-sm shadow-sm">
                        <span class="rounded-l-md font-semibold px-4 py-1 bg-primary-darkest text-white">Read our</span>
                        <span class=" bg-white rounded-r-md px-4 py-1 text-gray-600">Contribution Guide</span>
                    </a>
                    <a href="{{ route('docs.show', ['repository' => 'github', 'path' => 'DEVELOPMENT_FLOW.md']) }}"
                       class="max-w-max rounded-md overflow-hidden cursor-pointer hover:shadow-md transition-all duration-75 flex items-center text-sm shadow-sm">
                        <span class="rounded-l-md font-semibold px-4 py-1 bg-primary-darkest text-white">Read our</span>
                        <span class="bg-white rounded-r-md px-4 py-1 text-gray-600">Development Glow Guide</span>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <x-repositories.index :repositories="$repositories" />

    <x-cta-contact-us />


    <x-footer/>

</x-layout>
