@props([
    'item',
])
<li class="md:py-4">
    <a class="font-grotesk block font-extrabold text-lg border-3px border-transparent rounded-full px-7 py-5
               text-primary-dark
               active:bg-secondary active:border-secondary active:text-white
               hover:border-secondary hover:text-primary
               transition duration-300 ease-in-out
               {{ is_current_domain($item->domain) ? 'border-secondary text-secondary' : 'text-primary' }}"
       href="{{ route($item->route) }}">

        {{ app()->getLocale() === 'en' ? $item->en : $item->nl }}

    </a>
</li>
