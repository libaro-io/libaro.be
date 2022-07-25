@props(['subtitle' => false, 'title' => false, 'image', 'alt' => 'Image', 'reverse' => false])

<section class="px-4 max:px-0 xl:max-w-8xl mx-auto bg-white py-12 xl:py-28 grid grid-cols-24">
    <div class="col-span-24 xl:col-span-11 lg:mb-0 {{ $reverse ? 'order-2 xl:col-start-14' : 'order-1 mb-10.5' }}">
        <h3 class="font-gilroy font-extrabold text-lg text-secondary uppercase">{{ __($subtitle) }}</h3>

        <h2 class="font-gilroy font-bold text-3xl md:text-6xl xl:text-7xl text-primary-darkest mt-8 mb-8 xl:mb-20">{{ __($title) }}</h2>

        <div class="leading-normal font-semibold font-grotesk text-base md:text-paragraph text-primary-darkest">
            {{ $slot }}
        </div>
    </div>

    <div class="flex col-span-24 xl:col-span-12 rounded-outer overflow-hidden p-5 bg-grey-light border-2 border-grey-dark {{ $reverse ? 'order-1 mb-10.5' : 'order-2 xl:col-start-14' }}">
        <img class="object-cover h-full w-full overflow-hidden rounded-inner" src="{{ $image }}" alt="{{ $alt }}">
    </div>
</section>
