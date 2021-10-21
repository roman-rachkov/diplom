<div class="Cards">
    @foreach($products as $product)
        <x-card :product="$product" :discounts="$discounts"/>
    @endforeach
</div>

{{ $products->links('components.pagination') }}
