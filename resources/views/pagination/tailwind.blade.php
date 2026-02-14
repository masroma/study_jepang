@if ($paginator->hasPages())
    <nav class="flex items-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 text-sm text-gray-400 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 text-sm font-semibold text-white bg-brand-pink border border-brand-pink rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="px-3 py-2 text-sm text-gray-400 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
