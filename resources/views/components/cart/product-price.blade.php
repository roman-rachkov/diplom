@props(['dto'])
<div class="Cart-block Cart-block_price">
    @if($dto->sumPricesWithDiscount)
        <div class="Cart-price">
            <x-format-price :price="$dto->sumPricesWithDiscount" />
        </div>
        <div  class="Cart-price Cart-price_old">
            <x-format-price :price="$dto->sumPrice" />
        </div>
    @else
        <div class="Cart-price">
            <x-format-price :price="$dto->sumPrice" />
        </div>
    @endif
</div>
