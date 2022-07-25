@props(['title' => false, 'subtitle' => false, 'body' => false, 'image' => false, 'alt' => "Image"])

<div class="grid grid-cols-24 gap-y-10 max:gap-y-0 max:gap-x-10 pt-12 lg:pt-28 max:pt-0">
    <div class="col-span-24 lg:col-span-13 flex flex-col justify-center mt-16 lg:mt-0 px-6 max:px-0">
        @if($subtitle)
            <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-4 md:mb-15">{{ __($subtitle) }}</h2>
        @endif
        @if($title)
            <h2 class="text-xl font-gilroy font-bold leading-snug md:text-5xl max:leading-snug max:text-7.5xl text-white">{{ __($title) }}</h2>
        @endif

        @if($body)
            <p class="font-grotesk font-semibold text-base md:text-2xl mt-4 md:mt-10 lg:pb-20 max:pb-0 text-white md:leading-9">
                {{ __($body) }}
            </p>
        @endif
    </div>

    <div class="col-span-24 lg:col-span-11 lg:mt-20x max:mt-0">
        @if($image)
            <img class="mx-auto object-cover w-64 lg:w-1/2 max:w-screen
                        transform transition ease-in-out duration-300 hover:rotate-12 hover:scale-95"
                 src="{{ $image }}" alt="{{ $alt }}">
        @endif
    </div>
</div>
