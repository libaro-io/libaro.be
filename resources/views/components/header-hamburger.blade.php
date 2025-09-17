@props(['dark' => false])

<div x-show="!show" @click="show = ! show" class="flex items-center justify-between z-40 absolute w-full top-0 p-6 cursor-pointer">

    <a href="/">
        @if($dark)
            <img class="h-12 md:h-16" src="{{ asset('storage/images/libaro_logo_full_blue_without_tagline.svg') }}" alt="Logo Libaro">
        @else
            <img class="h-12 md:h-16" src="{{ asset('storage/images/libaro_logo_full_white_without_tagline.svg') }}" alt="Logo Libaro">
        @endif
    </a>

    <x-svg.menu class="{{ $dark ? 'text-primary-dark' : 'text-white' }}" />
</div>
