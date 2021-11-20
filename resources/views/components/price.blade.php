@props(['price', 'priceWithDiscount', 'blockClass', 'priceTagClass'])

<div class="Compare-feature">
    @if($dto->productPriceWithDiscount)
        <strong class="Compare-priceOld">
            {{$dto->getPriceInDollars($dto->product->avg_price)}}
        </strong>
    <strong class="Compare-price">
        {{$dto->getPriceInDollars($dto->productPriceWithDiscount)}}
    </strong>
    @else
        <strong class="Compare-price">
            {{$dto->getPriceInDollars($dto->product->avg_price)}}
        </strong>
    @endif
</div>