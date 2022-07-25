<x-layout>
    @section('title', page_title('Something went wrong'))

    <x-nav-bottom-container :dark=true/>

        <main>
            <div class="max-w-8xl px-12 max:px-0 mx-auto pt-32 pb-12 sm:pb-32 max:pb-64 lg:pt-0">
                <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-4 md:mb-15">
                    Oeps, er ging iets verkeerd...
                </h2>
                <h1 class="font-gilroy font-bold text-4xl md:text-7xl text-primary-darkest mb-10 md:mb-15">500 Server Error</h1>
            </div>

            @php $showcase = App\Models\Showcase::where('visible', 1)->inRandomOrder()->first(); @endphp
            <section class="bg-primary-light border-b-20 border-project-border mt-32 md:mt-64 lg:mt-470">
                <div class="max-w-8xl mx-auto p-4 lg:p-0">
                    <div
                        class="md:border-2 border-grey-dark rounded-outer overflow-hidden md:p-5 bg-grey-light transform -translate-y-1/2">
                        {{ $showcase->getFirstMedia('showcase_card')->img()->attributes(['class' => 'rounded-inner overflow-hidden w-full lg:h-620 object-cover']) }}
                    </div>
                    <div class="-mt-32 md:-mt-64 lg:-mt470">
                        <section
                            class="max-w-8xl mx-auto mb-7.5 py-8 lg:py-4 grid grid-cols-24 px-4 max:px-0 mt-12 lg:mt-0">
                            <h2 class="col-span-24 font-gilroy font-bold text-2xl md:text-5xl max:text-7xl text-primary-darkest mb-4">{{ $showcase->name }}</h2>
                            <div
                                class="col-span-24 font-gilroy font-bold text-xl md:text-2xl text-primary-darkest mb-10 md:mb-15">{!! \Illuminate\Support\Str::limit($showcase->description, 250) !!}</div>
                            <div class="col-span-24 group">
                                <a href="{{ route('showcase', ['showcase' => $showcase]) }}" class="max-w-max text-white pl-4 md:pl-7.5 py-2 border-2 border-primary-dark bg-primary-dark rounded-full flex items-center
                                      group-hover:bg-secondary-light group-hover:border-secondary-light
                                      transition duration-500 ease-in-out">
                                    <span class="mr-6 font-grotesk font-bold text-sm md:text-2xl">Benieuwd naar dit project?</span>
                                    <span class="flex items-center justify-center mr-4 h-6 w-6 md:h-12 md:w-12 rounded-full
                                        bg-secondary text-white
                                        group-hover:bg-white group-hover:text-secondary-light
                                        transition duration-500 ease-in-out">
                                <x-svg.arrow/>
                            </span>
                                </a>
                            </div>
                        </section>
                    </div>
                </div>
            </section>

        </main>

        <x-footer/>
</x-layout>
