@props(['title' => false, 'subtitle' => false, 'body' => false, 'dark' => true])

<div class="flex flex-col px-4 pt-32 max:pt-12 pb-14 max:pb-44">
    @if($subtitle)
        <h2 class="font-gilroy font-extrabold text-md md:text-lg uppercase text-secondary md:mb-4">{{ __($subtitle) }}</h2>
    @endif
    @if($title)
        <h2 class="font-gilroy font-bold leading-snug text-3xl md:text-5xl max:text-7.5xl {{ $dark ? 'text-white' : 'text-primary-darkest' }}">{{ __($title) }}</h2>
    @endif

    @if($body)
        <p class="font-grotesk font-semibold text-2xl mt-10 lg:pb-20 max:pb-0 {{ $dark ? 'text-white' : 'text-primary-darkest' }} leading-9">
            {{ __($body) }}
        </p>
    @endif
</div>
