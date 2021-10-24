<header class="Section-header">
    <h2 class="Section-title">{{__('seller.popular-products')}}</h2>
</header>
<div class="Cards">
    @foreach($products as $product)
        <x-card :product="$product" :discounts="$discounts"/>
    @endforeach
</div>
