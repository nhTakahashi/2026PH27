@if ($paginator->hasPages())
    <nav aria-label="社員一覧のページ送り">
        @if ($paginator->onFirstPage())
            <span>前へ</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">次へ</a>
        @else
            <span>次へ</span>
        @endif
    </nav>
@endif