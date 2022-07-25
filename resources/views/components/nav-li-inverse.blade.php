@props([
    'item',
])

<a class="md:py-4" href="{{ route($item->route) }}">
    <li class="font-grotesk font-extrabold text-lg border-3px border-transparent rounded-inner px-7 py-5
               text-primary-dark
               active:bg-secondary active:border-secondary active:text-white
               hover:border-secondary hover:text-primary
               transition duration-300 ease-in-out
               {{ is_current_domain($item->domain) ? 'border-secondary text-secondary' : 'text-primary' }}">
        {{ app()->getLocale() === 'en' ? $item->en : $item->nl }}
    </li>
</a>
