<x-layout>

    @section('title', page_title('Digital Innovation Partner'))

    <div class="hidden max:block border-b-10 border-secondary"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">
        <div class="max:max-w-8xl mx-auto pb-8">
            <x-nav/>
            <div class="grid grid-cols-24 gap-y-10 max:gap-y-0 max:gap-x-10 pt-12 lg:pt-28 max:pt-0">
                <div class="col-span-24 lg:col-span-13 flex flex-col mt-16 px-6 max:px-0">
                    <h2 class="text-xl font-gilroy font-bold leading-snug md:text-5xl max:leading-snug max:text-7.5xl text-white">{{ $repository->name }}</h2>

                    <p class="font-grotesk font-semibold text-base md:text-2xl mt-4 md:mt-10 lg:pb-4 max:pb-0 text-white md:leading-9">
                        {{ $repository->description }}
                    </p>

                    <ul class="flex gap-4 mt-8">
                        <li class="bg-white rounded-md px-4 py-1 flex items-center text-gray-600 text-sm">
                            <div>
                                last updated {{ $repository->lastUpdated->diffForHumans() }}
                            </div>
                        </li>
                        <li class="bg-white rounded-md px-4 py-1 flex items-center text-gray-600 text-sm">
                            version: {{ $repository->lastRelease }}
                        </li>
                        @if($repository->isPrerelease)
                            <li class="bg-white rounded-md px-4 py-1 flex items-center text-gray-600 text-sm">
                                prerelease
                            </li>
                        @endif
                    </ul>
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

                <p class="font-grotesk font-semibold text-base md:text-2xl mt-4 md:mt-10 lg:pb-4 max:pb-0 text-white md:leading-9">
                    {{ __("A list of open-source packages we maintain. Click on a package to go the the docs to view full installation and usage information.") }}
                </p>

                <ul class="flex gap-4 mt-8">
                    <li class="bg-white rounded-md px-4 py-1 flex items-center text-gray-600 text-sm">
                        <div>
                            last updated {{ $repository->lastUpdated->diffForHumans() }}
                        </div>
                    </li>
                    <li class="bg-white rounded-md px-4 py-1 flex items-center text-gray-600 text-sm">
                        version: {{ $repository->lastRelease }}
                    </li>
                    @if($repository->isPrerelease)
                        <li class="bg-white rounded-md px-4 py-1 flex items-center text-gray-600 text-sm">
                            prerelease
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container flex flex-col lg:flex-row items-start mx-auto gap-x-24 my-8 text-gray-700">
        <div class="space-y-4 mb-8 lg:mb-0">
            <div
                class="hover:shadow-md transition-all duration-200 flex min-w-64 bg-gray-200 rounded-md pl-4 pr-8 py-2">
                <img
                    src="{{ asset('storage/images/github_dark.png') }}"
                    class="h-6 w-6 mr-8 opacity-80"
                >
                <a href="{{ $repository->url }}" class="text-sm mt-0.5 text-gray-700 font-semibold">View on Github</a>
            </div>
            <div class="min-w-64 bg-gray-100 rounded-md pl-4 pr-8 py-2">
                @foreach($repository->documentationMenu as $menuItem)
                    @if($menuItem->standalone)
                        @foreach($menuItem->items as $item)
                            <a
                                class="text-sm w-full hover:bg-gray-50 py-2 px-2 -ml-2 rounded-md block {{ $current === $item->path ? 'font-semibold' : 'font-regular' }}"
                                href="{{ route('docs.show', ['repository' => $repository->slug, 'path' => $item->path]) }}">
                                {{ $item->name }}
                            </a>
                        @endforeach
                    @else
                        @if(count($menuItem->items) > 0)
                            <div>
                                <h2 class="mt-4 mb-2 text-primary-dark"
                                    style="padding-left: {{$menuItem->level * 10}}px;">
                                    {{ $menuItem->name }}
                                </h2>

                                <ul class="border-dashed border-l border-gray-200"
                                    style="margin-left: {{$menuItem->level * 10}}px;">
                                    @foreach($menuItem->items as $item)
                                        <li class="w-full hover:bg-gray-50 py-2 rounded-md">
                                            <a class="text-sm px-2 cursor-pointer flex items-center {{ $current === $item->path ? 'font-semibold' : 'font-regular' }}"
                                               href="{{ route('docs.show', ['repository' => $repository->slug, 'path' => $item->path]) }}">
                                                <span class="text-gray-300 mr-2">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="1">
                                                          <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                                    </svg>
                                                </span>
                                                {{ $item->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <div class="prose prose-gray xl:max-w-5xl 2xl:max-w-6xl">
            @if($repository->file->file)
                {!! Str::markdown($repository->file->file) !!}
            @endif
        </div>
    </div>

    <x-footer/>

</x-layout>
