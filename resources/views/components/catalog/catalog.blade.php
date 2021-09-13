@foreach($products as $product)
    <x-product.cart :product="$product"/>
@endforeach

{{ $products->links('components.catalog.pagination') }}
