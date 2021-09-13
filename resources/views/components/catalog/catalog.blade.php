<div class="Cards">
    @foreach($products as $product)
        <x-product.cart :product="$product"/>
    @endforeach
</div>

{{ $products->links('components.pagination') }}
