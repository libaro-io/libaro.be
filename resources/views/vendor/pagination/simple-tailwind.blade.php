@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center space-x-6">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}"
               rel="prev"
               class="font-grotesk font-extrabold text-lg border-3px border-transparent rounded-inner px-7 py-5
               text-primary-dark cursor-pointer
               active:bg-secondary active:border-secondary active:text-white
               hover:border-secondary hover:text-primary
               transition duration-300 ease-in-out">
                {!! __('Vorige') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               rel="next"
               class="font-grotesk font-extrabold text-lg border-3px border-transparent rounded-inner px-7 py-5
               text-primary-dark cursor-pointer
               active:bg-secondary active:border-secondary active:text-white
               hover:border-secondary hover:text-primary
               transition duration-300 ease-in-out
               text-primaryx">
                {!! __('Volgende') !!}
            </a>
        @endif
    </nav>
@endif
