<x-layout>
    @section('title', page_title($showcase->name))

    <div class="relative hidden max:block">
        <img class="absolute w-full h-full object-cover inset-0"
             src="{{ $showcase->image_header ? asset("/storage/$showcase->image_header") : asset("/storage/$showcase->image_card") }}"
             alt="{{ $showcase->name }}"/>
        <div class="absolute w-full h-full inset-0 bg-white bg-opacity-80 backdrop-filter backdrop-blur-sm"></div>
        <div class="relative lg:max-w-8xl mx-auto">
            <x-nav-bottom :nav="true"/>
            <x-header-showcase :showcase="$showcase" :tags="$tags"/>
        </div>
    </div>

    <div x-data="{ show: false }"
         class="relative max:hidden">
        <img class="absolute w-full h-full object-cover inset-0"
             src="{{ $showcase->image_header ? asset("/storage/$showcase->image_header") : asset("/storage/$showcase->image_card") }}"
             alt="{{ $showcase->name }}"/>
        <div class="absolute w-full h-full inset-0 bg-white bg-opacity-60 backdrop-filter backdrop-blur-sm"></div>
        <x-header-hamburger :dark=true/>
            <div x-show="show"
                 x-transition:enter="transition transform duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="z-30 bg-primary-dark fixed top-0 left-0 min-h-screen w-screen">
                <x-nav-full-screen/>
            </div>
            <x-header-showcase :showcase="$showcase" :tags="$tags"/>
    </div>

    <main>
        <section class="max-w-8xl mx-auto">
            <div class="grid grid-cols-24 px-8 max:px-0 pt-20x max:pt-0 max:pb-20">
                <div class="col-span-24 max:col-span-10 flex items-center justify-center pb-12x max:pb-0 pt-12 max:pt-29">
                    @if($showcase->getFirstMedia('showcase_logo'))
                        {{ $showcase->getFirstMedia('showcase_logo')->img()->attributes(['class' => 'object-contain h-32 xl:h-96 w-full']) }}
                    @else
                        {{ $showcase->client->getFirstMedia('client_logo')->img()->attributes(['class' => 'object-contain h-32 xl:h-96 w-full']) }}
                    @endif
                </div>
                <div
                    class="col-span-24 max:col-start-13 max:col-span-10 font-grotesk font-semibold text-2xl pt-12 pb-29 max:py-29 text-primary-darkest prose">
                    {!! $showcase->description !!}
                </div>
            </div>

            @if(count($showcase->keys) > 0)
                <div class="pb-4 sm:pb-24 -mt-20">
                    @foreach($showcase->keys as $key)
                        <x-key :number="$key->number" :title="$key->title" :body="$key->body" :prose=false/>
                    @endforeach
                </div>
            @endif

        </section>

        <section class="bg-primary-light border-b-20 border-project-border mt-32 md:mt-64 lg:mt-470">
            <div class="max-w-8xl mx-auto p-4 lg:p-0">
                <div
                    class="md:border-2 border-grey-dark rounded-outer overflow-hidden md:p-5 bg-grey-light transform -translate-y-1/2">
                    @if($showcase->getFirstMedia('showcase_extra'))
                        {{ $showcase->getFirstMedia('showcase_extra')->img()->attributes(['class' => 'rounded-inner overflow-hidden w-full lg:h-620 object-cover']) }}
                    @else
                        {{ $showcase->getFirstMedia('showcase_card')->img()->attributes(['class' => 'rounded-inner overflow-hidden w-full lg:h-620 object-cover']) }}
                    @endif
                </div>
                <div class="-mt-32 md:-mt-64 lg:-mt470">
                    @if($showcase->quotes()->where('visible', 1)->count() > 0)
                        @php $quote = $showcase->quotes()->where('visible', 1)->get()->random() @endphp
                        <section class="max-w-8xl mx-auto mb-7.5 py-8 md:py-4 grid grid-cols-24 px-4 max:px-0">
                            <div class="col-span-24 group">
                                <div class="grid grid-cols-24 mt-14 md:-mt-48x lg:-mt-64x">
                                    <div class="col-span-24 max:col-start-5 max:col-span-4">
                                        <div class="flex items-center justify-center">
                                            <div
                                                class="w-44 h-44 rounded-full border-2 border-primary-light bg-white p-3 ">
                                                {{ $quote->getFirstMedia('quote')->img()->attributes(['class' => 'rounded-full w-full h-full block']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-center justify-center max:justify-start col-span-24 max:col-start-10 max:col-span-14">
                                        <p class="text-center max:text-left pt-20 max:pt-0 font-grotesk font-semibold text-4xl text-primary-darkest">
                                            {{ __($quote->body) }}
                                        </p>
                                    </div>

                                    <div class="col-span-24 max:col-start-10 max:col-span-15">
                                        <p class="text-center max:text-left font-gilroy font-extrabold text-xl uppercase text-secondary py-15">
                                            {{ $quote->by }} • {{ $quote->job_title }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    @if($showcase->quotes()->where('visible', 1)->count() == 0 && $showcase->client_url)
                        <section
                            class="max-w-8xl mx-auto mb-7.5 py-8 lg:py-4 grid grid-cols-24 px-4 max:px-0 mt-12 lg:mt-0">
                            <h2 class="col-span-24 font-gilroy font-bold text-2xl md:text-5xl max:text-7xl text-primary-darkest mb-4">
                                Benieuwd naar het eindresultaat?</h2>
                            <div class="col-span-24 group">
                                <a href="{{ $showcase->client_url }}" target="_blank" class="max-w-max text-white pl-4 md:pl-7.5 py-2 border-2 border-primary-dark bg-primary-dark rounded-full flex items-center
                                          group-hover:bg-secondary-light group-hover:border-secondary-light
                                          transition duration-500 ease-in-out">
                                    <span
                                        class="mr-6 font-grotesk font-bold text-sm md:text-2xl">Bezoek {{ Str::of($showcase->type)->title() }}</span>
                                    <span class="flex items-center justify-center mr-4 h-6 w-6 md:h-12 md:w-12 rounded-full
                                            bg-secondary text-white
                                            group-hover:bg-white group-hover:text-secondary-light
                                            transition duration-500 ease-in-out">
                                    <x-svg.arrow/>
                                </span>
                                </a>
                            </div>
                        </section>
                    @endif
                </div>

            </div>
        </section>

        @if($showcase->quotes()->where('visible', 1)->count() > 0 && $showcase->client_url)
            <section
                class="max-w-8xl mx-auto mb-7.5 py-8 md:py-32 border-b-2 border-project-border grid grid-cols-24 px-4 max:px-0">
                <h2 class="col-span-24 font-gilroy font-bold text-2xl md:text-5xl max:text-7xl text-primary-darkest mb-4">
                    Benieuwd naar het eindresultaat?</h2>
                <div class="col-span-24 group">
                    <a href="{{ $showcase->client_url }}" target="_blank" class="max-w-max text-white pl-4 md:pl-7.5 py-2 border-2 border-primary-dark bg-primary-dark rounded-full flex items-center
                                      group-hover:bg-secondary-light group-hover:border-secondary-light
                                      transition duration-500 ease-in-out">
                        <span
                            class="mr-6 font-grotesk font-bold text-sm md:text-2xl">Bezoek {{ Str::of($showcase->type)->title() }}</span>
                        <span class="flex items-center justify-center mr-4 h-6 w-6 md:h-12 md:w-12 rounded-full
                                        bg-secondary text-white
                                        group-hover:bg-white group-hover:text-secondary-light
                                        transition duration-500 ease-in-out">
                                <x-svg.arrow/>
                            </span>
                    </a>
                </div>
            </section>
        @endif

    </main>

    <x-nav-bottom/>

    <x-footer/>
</x-layout>
