@props([
    'vacancy',
])

<div class="bg-white col-span-24 max:col-span-12 max:row-span-2 sm:border-2 border-primary-medium border-opacity-20 sm:rounded-outer overflow-hidden sm:mx-10 mb-90 transform transition hover:scale-105">
    <a href="{{ $vacancy->route }}" class="relative block h-full md:p-5">
        <div class="absolute z-30 md:m-5 inset-0 bg-gradient-to-t from-gray-800 to-white opacity-40 overflow-hidden sm:rounded-inner"></div>
        <img class="relative h-840 w-full object-cover sm:rounded-inner overflow-hidden" src="{{ asset("/storage/{$vacancy->image}") }}" alt="{{ $vacancy->title }}" />
        <div class="absolute z-40 bottom-20 left-0 px-4 sm:px-20">
            <div class="flex flex-wrap space-x-2">
                @foreach($vacancy->tags()->pluck('name') as $tag)
                    <h3 class="block font-gilroy font-bold text-sm uppercase bg-secondary text-white px-2 rounded-lg my-1">{{ $tag }}</h3>
                @endforeach
            </div>
            <h2 class="mt-4 font-gilroy font-bold text-4xl sm:text-6xl text-white mb-3">{{ $vacancy->title }}</h2>
        </div>
    </a>
</div>
