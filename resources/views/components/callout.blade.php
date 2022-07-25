@props([ 'image', 'altText' => 'Image', 'title' => false, 'subtitle' => false ])

<section class="bg-primary-light border-b-20 border-project-border md:mt-64 lg:mt-470">
    <div class="relative max-w-8xl mx-auto p-4 lg:p-0">
        <div class="md:border-2 border-grey-dark rounded-outer md:p-5 bg-grey-light overflow-hidden transform md:-translate-y-1/2">
            <img class="rounded-inner overflow-hidden w-full lg:h-620 object-cover object-top" src='{{ $image }}' alt="{{ $altText }}">
        </div>

        <div class="px-12 max:px-0 lg:max-w-8xl mx-auto mt-12 md:-mt-48 max:-mt-48 pb-12 lg:pb-24">
            @if($subtitle)
                <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-4 md:mb-15">{{ __($subtitle) }}</h2>
            @endif

            @if($title)
                <h2 class="font-gilroy font-bold text-4xl md:text-7xl text-primary-darkest mb-10 md:mb-15">{{ __($title) }}</h2>
            @endif

            <div class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
