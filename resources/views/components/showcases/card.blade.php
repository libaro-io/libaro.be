@props([
    'showcase',
    'loop',
])

@php
    $bgImage = asset("/storage/{$showcase->image_card}");
@endphp

<div class="h-840 bg-white col-span-24 max:col-span-12 max:row-span-2 max:row-start-{{ $loop->index + 1 }} border-primary-medium border-opacity-20 lg:rounded-large lg:mx-10 lg:mb-90
            transition duration-300 transform hover:scale-105">
    <a href="{{ $showcase->route }}" class="relative block h-full md:p-5">
        <div class="absolute z-30 md:m-5 inset-0 bg-gradient-to-t from-primary-darkest via-transparent to-transparent opacity-80 lg:rounded-large"></div>
        <img class="relative h-full w-full object-cover lg:rounded-large" src="{{ $bgImage }}" alt="{{ $showcase->name }}" />
        <div class="absolute z-40 bottom-20 left-0 px-4 sm:px-20">
            <h3 class="font-gilroy font-light leading-relaxed tracking-wide text-sm uppercasex bg-secondary text-white mb-5 max-w-max px-3 py-1 rounded-lg">{{ __($showcase->type) }}</h3>
            <h2 class="font-gilroy font-bold text-2xl sm:text-6xl text-white mb-3">{{ Str::limit($showcase->name, 50) }}</h2>
            <p class="font-grotesk font-semibold text-lg text-white">{{ __($showcase->client->name) }}</p>
        </div>
    </a>
</div>
