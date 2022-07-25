<x-layout>
    @section('title', page_title($article->title))

    <x-nav-bottom-container :dark=true/>

        <main class="relative ">
            <div class="max-w-8xl px-12 max:px-0 mx-auto pt-32 max:pt-0">
                <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-4 md:mb-15">
                    <div class="flex flex-row flex-wrap">
                        @foreach($tags as $tag)
                            <a href="{{ route('articles', ['filter' => $tag->slug]) }}"
                               class="m-1 md:m-2 font-gilroy font-light leading-relaxed tracking-wide text-xs md:text-sm uppercasex bg-secondary text-white max-w-max px-3 py-1 rounded-lg">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </h2>
                <h1 class="font-gilroy font-bold text-4xl md:text-7xl text-primary-darkest mb-10 md:mb-15">{{ $article->title }}</h1>

                @if($article->author || $article->publish_date)
                    <p class="font-grotesk mb-8">
                        @if($article->author)
                            {{ $article->author }}
                        @endif
                        @if($article->publish_date)
                            op {{ $article->publish_date->format('d-m-Y') }}
                        @endif
                    </p>
                @endif
                <div
                    class="font-grotesk font-semibold text-base text-primary-darkest mb-10 md:mb-15 prose">{!! $article->body !!}</div>
            </div>
            @if($article->getFirstMedia('article_one') || $article->getFirstMedia('article_two'))
                <section x-data="{ first: true }"
                         class="bg-primary-light border-b-20 border-project-border mt-32 md:mt-64 lg:mt-470">
                    <div class="max-w-8xl mx-auto p-4 lg:p-0">
                        <div
                            class="md:border-2 border-grey-dark md:rounded-outer overflow-hidden md:p-5 bg-grey-light transform -translate-y-1/3">
                            <div class="flex flex-nowrap overflow-hidden">
                                @if($article->getFirstMedia('article_one'))
                                    <div x-show="first"
                                         x-transition:enter="transition ease-out duration-75"
                                         x-transition:enter-start="opacity-0 transform"
                                         x-transition:enter-end="opacity-100 transform"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="opacity-100 transform"
                                         x-transition:leave-end="opacity-0 transform"
                                         class="w-full"
                                    >
                                        {{ $article->getFirstMedia('article_one')->img()->attributes(['class' => 'bg-white md:rounded-inner overflow-hidden min-w-full lg:h-620 object-cover']) }}
                                    </div>
                                @endif
                                @if($article->getFirstMedia('article_two'))
                                    <div x-show="!first"
                                         x-transition:enter="transition ease-out duration-75"
                                         x-transition:enter-start="opacity-0 transform"
                                         x-transition:enter-end="opacity-100 transform"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="opacity-100 transform"
                                         x-transition:leave-end="opacity-0 transform"
                                         class="w-full"
                                    >
                                        {{ $article->getFirstMedia('article_two')->img()->attributes(['class' => 'bg-white md:rounded-inner overflow-hidden min-w-full lg:h-620 object-cover']) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="-mt-12 md:-mt-28 lg:-mt-48 flex justify-center sm:px-2">
                            @if($article->getFirstMedia('article_one') && $article->getFirstMedia('article_two'))
                                <div @click="first = true" class="cursor-pointer p-2">
                                    <div class="w-2 h-2 rounded-full"
                                         x-bind:class="first ? 'bg-primary-dark' : 'bg-primary-medium'"></div>
                                </div>
                                <div @click="first = false" class="cursor-pointer p-2">
                                    <div class="w-2 h-2 rounded-full"
                                         x-bind:class="first ? 'bg-primary-medium' : 'bg-primary-dark'"></div>
                                </div>
                            @endif
                        </div>

                        @if($article->link)
                            <div class="group flex justify-center mt-24">
                                <a href="{{ $article->link }}" class="mb-20 text-white pl-7.5 py-2 border-2 border-primary-medium bg-primary-medium rounded-full flex items-center
                                  group-hover:bg-secondary-light group-hover:border-secondary-light
                                  transition duration-500 ease-in-out">
                                    <span class="mr-6 font-bold text-xl">{{ __('Lees Artikel') }}</span>
                                    <span class="flex items-center justify-center mr-4 h-12 w-12 rounded-full
                                    bg-secondary text-white
                                    group-hover:bg-white group-hover:text-secondary-light
                                    transition duration-500 ease-in-out">
                                    <x-svg.arrow/>
                                </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </section>
            @elseif($article->link)
                <div class="group flex justify-center mt-24">
                    <a href="{{ $article->link }}" class="mb-20 text-white pl-7.5 py-2 border-2 border-primary-medium bg-primary-medium rounded-full flex items-center
                                  group-hover:bg-secondary-light group-hover:border-secondary-light
                                  transition duration-500 ease-in-out">
                        <span class="mr-6 font-bold text-xl">{{ __('Lees Artikel') }}</span>
                        <span class="flex items-center justify-center mr-4 h-12 w-12 rounded-full
                                    bg-secondary text-white
                                    group-hover:bg-white group-hover:text-secondary-light
                                    transition duration-500 ease-in-out">
                                    <x-svg.arrow/>
                                </span>
                    </a>
                </div>
            @endif

        </main>

        <x-nav-bottom/>

        <x-footer/>
</x-layout>
