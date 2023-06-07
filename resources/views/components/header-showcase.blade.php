@props([
    'showcase',
    'tags'
])

<div class="relative pt-32 max:pt-10 px-4 md:pl-12 max:px-0 pb-4">
    <h3 class="font-gilroy font-extrabold text-lg text-secondary uppercase mb-4">{{ __($showcase->type) }}</h3>
    <h2 class="font-gilroy font-bold text-5xl md:text-h2 text-primary-darkest break-words">{{ __($showcase->name) }}</h2>

    <p class="leading-normal font-semibold font-grotesk text-xl md:text-paragraph text-primary-darkest mt-10">
        <span class="block">{{ __($showcase->client->name) }}</span>
    </p>
    <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-12 lg:mb-36">
        <div class="flex flex-wrap -ml-1 md:-ml-2">
            @foreach($tags as $tag)

                <a href="{{ route('our-realizations', ['filter' => $tag->slug]) }}"
                   class="m-1 md:m-2 font-gilroy font-light leading-relaxed tracking-wide text-xs md:text-sm uppercasex bg-secondary text-white max-w-max px-3 py-1 rounded-lg">{{ $tag->name }}</a>
            @endforeach
        </div>
    </h2>
</div>
