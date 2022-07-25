<nav class="overflow-y-scroll flex flex-col pt-14 items-center justify-between space-y-4 menu text-white">
    <div @click="show = ! show" class="flex items-center justify-between z-40 fixed w-full top-0 p-6 cursor-pointer">
        <img class="h-16" src="{{ asset('storage/images/libaro_logo_full_white_without_tagline.svg') }}" alt="Logo Libaro" />
        <x-svg.menu class="text-white" />
    </div>



    <ul class="pt-20 flex flex-col items-center uppercase space-y-1">
        @foreach(\App\Models\NavigationItem::main() as $item)
            <x-nav-li :item="$item" :fullScreen=true />
        @endforeach
    </ul>

    <ul class="flex flex-col items-center uppercase space-y-1">
        @foreach(\App\Models\NavigationItem::secondary() as $item)
            <x-nav-li :item="$item" :fullScreen=true :small=true />
        @endforeach
    </ul>

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
</nav>
