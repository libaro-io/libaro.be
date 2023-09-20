<x-layout>
    @section('title', page_title($vacancy->title))

    <x-nav-bottom-container :dark=true/>

        <main class="relative pt-20 max:pt-0">
            <div class="max-w-8xl px-12 max:px-0 pb-8 mx-auto">
                <h1 class="font-gilroy font-bold text-4xl md:text-7xl text-primary-darkest">{{ $vacancy->title }}</h1>
                <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-4 md:mb-4">
                    <div class="flex space-x-6">
                        @foreach($tags as $tag)
                            <h3 class="block font-gilroy font-extrabold text-base uppercase bg-secondary text-white px-4 py-1 rounded-full my-5">{{ $tag->name }}</h3>
                        @endforeach
                    </div>
                </h2>
                <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">{{$vacancy->description }}</p>
            </div>

            <section class="max-w-8xl mx-auto divide-y-2 divide-primary-light">
                @foreach($vacancy->competences as $competence)
                    <div class="pt-4">
                        <x-key :number="$competence->number" :title="$competence->title" :body="$competence->body"
                               :prose="true"/>
                    </div>
                @endforeach
            </section>

            <section class=" mt-32 md:mt-64 lg:mt-470">
                <div class="max-w-8xl mx-auto p-4 lg:p-0">

                    <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 items-center justify-center lg:-mt-40 mb-20">
                        <div class="group flex justify-center ">
                            <a href="mailto:{{ config('mail.info.address') }}" class=" text-white pl-7.5 py-2 border-2 border-primary-medium bg-primary-medium rounded-full flex items-center
                          group-hover:bg-secondary-light group-hover:border-secondary-light
                          transition duration-500 ease-in-out">
                                <span class="mr-6 font-bold text-xl">{{ __('Solliciteer Nu') }}</span>
                                <span class="flex items-center justify-center mr-4 h-12 w-12 rounded-full
                                            bg-secondary text-white
                                            group-hover:bg-white group-hover:text-secondary-light
                                            transition duration-500 ease-in-out">
                                    <x-svg.arrow/>
                                </span>
                            </a>
                        </div>

                        @if($alternative)
                            <div class="ml-4 text-primary-dark text-center">
                                <a
                                    class="hover:underline"
                                    href="{{ route('vacancies.show', ['vacancy' => $alternative ]) }}">
                                    Niet je ding? Bekijk eens deze vacature: {{ $alternative->title }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <x-vacancies.our-offer />


                </div>
            </section>
            <section class="max-w-8xl mx-auto divide-y-2 mt-20">
            <div class="group flex justify-center  mb-10">
                <a href="mailto:{{ config('mail.info.address') }}" class=" text-white pl-7.5 py-2 border-2 border-primary-medium bg-primary-medium rounded-full flex items-center
                          group-hover:bg-secondary-light group-hover:border-secondary-light
                          transition duration-500 ease-in-out">
                    <span class="mr-6 font-bold text-xl">{{ __('Solliciteer Nu') }}</span>
                    <span class="flex items-center justify-center mr-4 h-12 w-12 rounded-full
                                            bg-secondary text-white
                                            group-hover:bg-white group-hover:text-secondary-light
                                            transition duration-500 ease-in-out">
                                    <x-svg.arrow/>
                                </span>
                </a>
            </div>

            @if($vacancy->getFirstMedia('vacancy'))
                <div
                    class="md:border-2 border-grey-dark rounded-outer overflow-hidden md:p-5 bg-grey-light transform ">
                    {{ $vacancy->getFirstMedia('vacancy')->img()->attributes(['class' => 'rounded-inner overflow-hidden w-full lg:h-620 object-cover object-top']) }}
                </div>
            @endif
            </section>
        </main>

        <x-nav-bottom/>

        <x-footer/>
</x-layout>
