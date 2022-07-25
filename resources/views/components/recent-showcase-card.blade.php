@props(['showcase'])

<a href="{{ $showcase->route }}"
   class="relative sm:border-30 shadow-xl xl:shadow-none border-white bg-white xl:border-0 col-span-3 md:col-span-2 xl:col-span-1 rounded-inner-sm overflow-hidden cursor-pointer
        flex flex-col justify-end
        h-630 px-7.5x pb-12x
        transform hover:scale-105
        transition duration-500 ease-in-out">
    <div class="absolute z-30 inset-0 bg-gradient-to-t from-primary-darkest via-transparent to-transparent opacity-80 rounded-inner-sm overflow-hidden"></div>

    {{ $showcase->getFirstMedia('showcase_card')->img()->attributes(['class' => 'relative h-full w-full object-cover sm:rounded-inner-sm overflow-hidden']) }}
    <div class="absolute z-40 bottom-10 left-0 px-4 sm:px-10">
        <h3 class="uppercase text-secondary font-gilroy font-extrabold text-base">{{ $showcase->type }}</h3>
        <h2 class="text-white font-gilroy font-bold text-4xl">{{ $showcase->name }}</h2>
        <p class="font-grotesk font-semibold text-lg text-white">{{ __($showcase->client->name) }}</p>
    </div>
</a>
