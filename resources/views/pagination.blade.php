@if ($paginator->hasPages())
    <div class="pt-pagination">
        <nav aria-label="Page navigation">
            <ul class="pagination-custom text-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li aria-disabled="true" aria-label="@lang('pagination.previous')" class="page-item">
                        <a class="page-link" href="javascript:void(0)">&lsaquo;</a>
                    </li>
                @else
                    <li>
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                                <li class="page-item active">
                                    <span aria-current="page" class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a class="next page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                            aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="next page-link disabled" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
