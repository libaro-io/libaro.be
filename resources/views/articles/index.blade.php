<x-layout>
    @section('title', page_title('Blog'))

    <x-nav-bottom-container :dark=true />

    <div class="relative">
        <div class="hidden lg:block bg-primary-light absolute inset-0 mt-96 mb-64 border-b-30 border-t-30 border-primary-medium border-opacity-5"></div>

        <main class="relative max-w-8xl mx-auto">
            <div class="grid grid-cols-24 auto-rows-minx">
                <div class="row-span-1 row-start-1 col-span-24 max:col-span-12 mx-4 md:mx-14 max:mx-0 mt-32 max:mt-0 max:min-h-500 mb-15 max:mb-0">
                    <h1 class="font-gilroy font-bold text-4xl md:text-7xl text-primary-darkest mb-10 md:mb-15">{{ __('Blog') }}</h1>
                    <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">{{ __('Leuke nieuwtjes, vreemde hersenkronkels, kennisdeling en meer vindt u hier.') }}</p>
                @if($filters)
                        <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">{{ 'Artikels met tag: ' . implode(', ', $filters) }}</p>
                        <a href="{{ route('articles') }}" class="flex items-center font-grotesk text-lg text-primary-dark my-2.5 hover:underline">toon alle artikels <x-svg.arrow /></a>
                    @endif
                </div>

                @foreach($articles as $article)
                    <div class="h-420 md:h-620 lg:h-840 bg-white col-span-24 max:col-span-12 max:row-span-2 max:row-start-{{ $loop->index + 1 }} border-2 border-primary-medium border-opacity-20 lg:rounded-outer lg:mx-10 lg:mb-90
                                transition duration-300 transform hover:scale-105">
                        <a href="{{ $article->route }}" class="relative block h-full md:p-5">
                            <div class="absolute z-30 md:m-5 inset-0 bg-gradient-to-t from-primary-darkest via-transparent to-transparent opacity-80 lg:rounded-inner overflow-hidden"></div>
                            @if($article->getFirstMedia('article_one'))
                                <div class="relative h-full w-full object-cover lg:rounded-inner overflow-hidden">
                                {{ $article->getFirstMedia('article_one') }}
                                </div>
                            @endif

                            <div class="absolute z-40 bottom-6 lg:bottom-20 left-0 px-4 sm:px-20">
                                <div class="flex flex-wrap space-x-2">
                                    @foreach($article->tags()->pluck('name') as $tag)
                                        <h3 class="block font-gilroy font-bold text-sm uppercase bg-secondary text-white px-2 rounded-lg my-1">{{ $tag }}</h3>
                                    @endforeach
                                </div>
                                <h2 class="mt-4 font-gilroy font-bold text-2xl md:text-6xl text-white mb-3">{{ $article->title }}</h2>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            <div class="px-4 pt-12 lg:pt-0">
                {{ $articles->links() }}
            </div>

        </main>

    </div>


    <x-nav-bottom />

    <x-footer />
</x-layout>
