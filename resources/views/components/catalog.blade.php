<div class="Cards">
    @foreach($products as $product)
        <x-cart :product="$product"/>
    @endforeach
</div>

{{ $products->links('components.pagination') }}
