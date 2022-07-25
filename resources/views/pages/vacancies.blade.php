<x-layout>
    @section('title', page_title('Vacatures'))

    <x-nav-bottom-container :dark=true />

    <main class="relative ">
        <div class="max-w-8xl px-12 max:px-0 mx-auto pt-32 max:pt-0">
            <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-4">{{ __('Zoektocht naar u') }}</h2>
            <h1 class="font-gilroy font-bold text-4xl md:text-7xl text-primary-darkest mb-10 md:mb-15">{{ __('Vacatures') }}</h1>
            <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">{{ __('Wij zoeken naar gepassioneerde kandidaten die ambitie hebben voor web en mobile development. Bent u nieuwsgierig naar tech? Is teamwork op uw lijf geschreven? Ziehier de mogelijkheden.') }}</p>
            <p class="text-primary-darkest mt-8">Ben je een recruiter? Gelieve <a class="underline" href="https://www.youtube.com/watch?v=lLWEXRAnQd0&ab_channel=BobRoss">Bob</a> te mailen.</p>
        </div>

        <div class="bg-projects-bg border-b-30 border-project-border py-10.5 xl:py-0 xl:h-768 mt-4 max:mt-32">
            <div class="relative max-w-9xl mx-auto">
                <div class="xl:absolute xl:top-0 xl:left-0 xl:bg-white xl:rounded-outer xl:shadow-2xl grid xl:grid-cols-3 gap-10.5 xl:-mt-14 p-7.5">
                    @foreach($vacancies as $vacancy)
                        <a href="{{ $vacancy->route }}"
                           class="relative sm:border-30 shadow-xl xl:shadow-none border-white bg-white xl:border-0 col-span-3 md:col-span-2 xl:col-span-1 rounded-inner overflow-hidden cursor-pointer
                                  flex flex-col justify-end
                                  h-630 px-7.5x pb-12x
                                  transform hover:scale-105
                                  transition duration-500 ease-in-out">
                            <div class="absolute z-30 inset-0 bg-gradient-to-t from-primary-darkest via-transparent to-transparent opacity-80 sm:rounded-inner overflow-hidden"></div>
                            {{ $vacancy->getFirstMedia('vacancy')->img()->attributes(['class' => 'relative h-full w-full object-cover sm:rounded-inner overflow-hidden']) }}
                            <div class="absolute z-40 bottom-10 left-0 px-4 sm:px-10">
                                <h2 class="text-white font-gilroy font-bold text-4xl">{{ $vacancy->title }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

        @if($vacancies->count() > 3)
            <div class="bg-primary-light border-b-30 border-t-30 border-primary-medium border-opacity-5 py-24">
                <div class="max-w-8xl mx-auto grid grid-cols-24">
                    @foreach($vacancies->skip(3) as $vacancy)
                        @if($vacancy->image)
                            <x-vacancies.card :vacancy="$vacancy" />
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <x-vacancies.student />

    </main>

    <x-nav-bottom />

    <x-footer />
</x-layout>
