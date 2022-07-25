@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-lg font-medium text-primary-medium bg-white cursor-default leading-5">
                    {!! __('Vorige') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-lg font-medium text-primary-dark bg-white leading-5 hover:text-primary-dark focus:outline-none focus:ring ring-primary-medium active:bg-gray-100 active:text-primary-dark transition ease-in-out duration-150">
                    {!! __('Vorige') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-lg font-medium text-primary-dark bg-white leading-5 hover:text-primary-dark focus:outline-none focus:ring ring-primary-medium active:bg-gray-100 active:text-primary-dark transition ease-in-out duration-150">
                    {!! __('Volgende') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-lg font-medium text-primary-medium bg-white cursor-default leading-5">
                    {!! __('Volgende') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-lg text-primary-dark font-gilroy leading-5">
                    {!! __('Toon') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('tot') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('van') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('resultaten') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-lg font-medium text-primary-dark bg-white cursor-default leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-lg font-medium text-primary-medium bg-white leading-5 hover:text-primary-dark focus:z-10 focus:outline-none focus:ring ring-primary-medium active:bg-gray-100 active:text-primary-medium transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-lg font-medium text-primary-medium bg-white cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-lg font-medium text-primary-dark bg-white cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-lg font-medium text-primary-medium bg-white leading-5 hover:text-primary-dark focus:z-10 focus:outline-none focus:ring ring-primary-medium active:bg-gray-100 active:text-primary-dark transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-lg font-medium text-primary-medium bg-white leading-5 hover:text-primary-dark focus:z-10 focus:outline-none focus:ring ring-primary-medium active:bg-gray-100 active:text-primary-medium transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-lg font-medium text-primary-medium bg-white cursor-default leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
