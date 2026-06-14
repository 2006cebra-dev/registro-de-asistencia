@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <p class="text-sm text-gray-400">
                    Mostrando
                    @if ($paginator->firstItem())
                        <span class="font-medium text-gray-200">{{ $paginator->firstItem() }}</span>
                        a
                        <span class="font-medium text-gray-200">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    de
                    <span class="font-medium text-gray-200">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div class="pagination-links">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white/5 border border-white/10 cursor-not-allowed rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white/5 border border-white/10 rounded-lg hover:bg-yellow-500/20 hover:text-yellow-400 hover:border-yellow-500/30 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white/5 border border-white/10 rounded-lg cursor-default">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-yellow-400 bg-yellow-500/20 border border-yellow-500/30 rounded-lg cursor-default">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white/5 border border-white/10 rounded-lg hover:bg-yellow-500/20 hover:text-yellow-400 hover:border-yellow-500/30 transition-all" aria-label="Ir a página {{ $page }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white/5 border border-white/10 rounded-lg hover:bg-yellow-500/20 hover:text-yellow-400 hover:border-yellow-500/30 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @else
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white/5 border border-white/10 cursor-not-allowed rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif