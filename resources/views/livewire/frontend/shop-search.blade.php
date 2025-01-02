<div>

<input type="text"   wire:model.live="query"  placeholder="Search products..." class="form-control" />
@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

    @if(!empty($query))
        <div class="list-group mt-2">
            @forelse($products as $product)
                <a href="{{ route('shop-detail', $product->unique_id) }}" class="list-group-item list-group-item-action">
                    {{ $product->title }}
                </a>
            @empty
                <div class="list-group-item">No products found</div>
            @endforelse
        </div>
    @endif

</div>
