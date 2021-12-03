<header class="Section-header">
    <h2 class="Section-title">{{__('seller.popular-products')}}</h2>
</header>
<div class="Cards">
    @foreach($productsDiscountsDTOs as $dto)
        <x-card :dto="$dto" />
    @endforeach
</div>
