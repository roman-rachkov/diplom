{{--@dd($paginator->currentPage())--}}
@if ($paginator->hasPages())
    <div class="Pagination">
        <div class="Pagination-ins">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a onclick="return false" class="Pagination-element Pagination-element_prev">
                    <img src="{{ asset('assets/img/icons/prevPagination.svg') }}" alt="prevPagination.svg"/>
                </a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="Pagination-element Pagination-element_prev">
                    <img src="{{ asset('assets/img/icons/prevPagination.svg') }}" alt="prevPagination.svg"/>
                </a>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a onclick="return false" class="Pagination-element Pagination-element_current">
                                <span class="Pagination-text">{{ $page }}</span>
                            </a>
                        @else
                            <a class="Pagination-element" href="{{ $url }}">
                                <span class="Pagination-text">{{ $page }}</span>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="Pagination-element Pagination-element_prev" href="{{ $paginator->nextPageUrl() }}">
                    <img src="{{ asset('assets/img/icons/nextPagination.svg') }}" alt="nextPagination.svg"/>
                </a>
            @else
                <a onclick="return false"  class="Pagination-element Pagination-element_prev" href="#">
                    <img src="{{ asset('assets/img/icons/nextPagination.svg') }}" alt="nextPagination.svg"/>
                </a>
            @endif
        </div>
    </div>
@endif
