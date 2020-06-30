@if ($paginator->hasPages())
    <nav class="blog-pagination">
        @if ($paginator->hasMorePages())
        	<a class="btn btn-outline-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">Older</a>
        @else
        	<a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Older</a>
        @endif
        @if ($paginator->onFirstPage())
        	<a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
        @else
        	<a class="btn btn-outline-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">Newer</a>
        @endif
    </nav>
@endif
