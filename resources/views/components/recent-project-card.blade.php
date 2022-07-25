@props(['mainTitle' => '','secondaryTitle1' => '', 'secondaryTitle2' => '',  'image' => ''])

@php
    $bgImage = asset("/storage/{$image}");
@endphp

<div class="sm:border-30 shadow-xl xl:shadow-none border-white xl:border-0 col-span-4 md:col-span-2 xl:col-span-1 rounded-xl cursor-pointer
            flex flex-col justify-end
            h-630 px-7.5 pb-12
            transform hover:scale-105
            transition duration-500 ease-in-out"
     style="background-image: url('{{ $bgImage }}'); background-size: cover">
    <h3 class="uppercase text-secondary font-gilroy font-extrabold text-base">{{ $secondaryTitle1 }}</h3>
    <h3 class="uppercase text-secondary font-gilroy font-extrabold text-base">{{ $secondaryTitle2 }}</h3>
    <h2 class="text-white font-gilroy font-bold text-4xl">{{ $mainTitle }}</h2>
</div>
