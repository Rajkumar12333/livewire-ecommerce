@if ($paginator->hasPages())
    <div class="product__pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled"><i class="fa fa-long-arrow-left"></i></span>
        @else
            <a href="#" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                <i class="fa fa-long-arrow-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="disabled">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="#" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="#" wire:click="nextPage" wire:loading.attr="disabled" rel="next">
                <i class="fa fa-long-arrow-right"></i>
            </a>
        @else
            <span class="disabled"><i class="fa fa-long-arrow-right"></i></span>
        @endif
    </div>
@endif