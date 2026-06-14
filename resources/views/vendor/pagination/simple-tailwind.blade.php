@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex gap-2 items-center justify-between">
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white/5 border border-white/10 cursor-not-allowed rounded-lg">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white/5 border border-white/10 rounded-lg hover:bg-yellow-500/20 hover:text-yellow-400 hover:border-yellow-500/30 transition-all">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white/5 border border-white/10 rounded-lg hover:bg-yellow-500/20 hover:text-yellow-400 hover:border-yellow-500/30 transition-all">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white/5 border border-white/10 cursor-not-allowed rounded-lg">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif