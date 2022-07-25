@props([
    'item',
    'fullScreen' => false,
    'small' => false,
])

<a href="{{ route($item->route) }}" class="{{ $fullScreen ? 'py-0' : 'py-4' }}">
    <li class="font-grotesk font-extrabold text-white border-transparent rounded-full
               active:border-white active:bg-white active:text-secondary
               hover:border-white
               focus:bg-white focus:border-white
               transition duration-500 ease-in-out
               {{ $small ? 'text-md px-4 py-3 border-2' : 'text-lg px-7 py-5 border-3px' }}
               {{ is_current_domain($item->domain) ? 'bg-none border-3px border-secondary-light text-white' : 'text-white' }}">
        {{ app()->getLocale() === 'en' ? $item->en : $item->nl }}
    </li>
</a>
