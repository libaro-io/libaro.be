<nav class="flex pt-14 items-end justify-between">
    <a href="/" class="mb-10 max:mb-0 max:pb-5">
        <img class="w-205" src="{{ asset('storage/images/libaro_logo_full_white_without_tagline.svg') }}"
             alt="Libaro Logo">
    </a>

    <div>
        <ul class="flex justify-end items-center space-x-2 menu text-white mr-4">
            @foreach(\App\Models\NavigationItem::secondary() as $item)
                <li>
                    <a class=" cursor-pointer bg-white hover:bg-opacity-25 px-4 py-1 rounded-md transition-all duration-200
                            {{ is_current_domain($item->domain) ? 'bg-opacity-25' : 'bg-opacity-0' }}"
                        href="{{ route($item->route) }}"
                    >
                        {{ app()->getLocale() === 'en' ? $item->en : $item->nl }}
                    </a>
                </li>
            @endforeach

            <ul class="flex divide-x divide-primary-light">
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
        </ul>
        <ul class="flex items-center uppercase space-x-2 menu text-white">
            @foreach(\App\Models\NavigationItem::main() as $item)
                <x-nav-li :item="$item"/>
            @endforeach
        </ul>
    </div>

</nav>
