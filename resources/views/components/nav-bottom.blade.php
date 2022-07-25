@props(['nav' => false])

<nav
    class="max-w-8xl mx-auto max:pb-24 flex flex-col max:flex-row justify-between {{ $nav ? 'pt-14 items-end' : 'py-29 items-center' }}">
    <a href="/" class="mb-10 max:mb-0 max:pb-5">
        <img class="w-205" src="{{ asset('/storage/images/libaro_logo_full_blue_without_tagline.svg') }}"
             alt="Libaro Logo">
    </a>

    <div class="flex flex-col-reverse md:flex-col">
        <ul class="flex items-center uppercase md:space-x-2 menu text-white {{ $nav ? 'justify-end mr-4' : 'mt-8 md:mt-0 flex-col md:flex-row space-y-4 md:space-y-0 justify-center xl:justify-end lg:mr-4' }}">
            @foreach(\App\Models\NavigationItem::secondary() as $item)
                <li>
                    <a
                        class="
                text-primary-dark cursor-pointer bg-primary-light  hover:bg-opacity-75 px-4 py-1 rounded-md transition-all duration-200
                {{ is_current_domain($item->domain) ? 'bg-opacity-75' : 'bg-opacity-0' }}
                            "
                        href="{{ route($item->route) }}">
                        {{ app()->getLocale() === 'en' ? $item->en : $item->nl }}
                    </a>
                </li>
            @endforeach
            @if($nav)
                <ul class="text-primary-dark flex divide-x divide-primary-dark">
                    <li class="px-2 {{ app()->getLocale() === 'en' ? 'opacity-90 font-bold' : 'opacity-60 hover:underline' }}">
                        <a href="/en">
                            EN
                        </a>
                    </li>
                    <li class="px-2 {{ app()->getLocale() === 'nl' ? 'opacity-90 font-bold' : 'opacity-60 hover:underline' }}">
                        <a href="/nl">
                            NL
                        </a>
                    </li>
                </ul>
            @endif
        </ul>
        <ul class="mx-auto justify-center lg:mx-0 flex flex-col flex-wrap md:flex-row uppercase space-y-4 md:space-y-0 md:space-x-2 menu text-white text-center">
            @foreach(\App\Models\NavigationItem::main() as $item)
                <x-nav-li-inverse :item="$item"/>
            @endforeach
        </ul>
    </div>
</nav>
