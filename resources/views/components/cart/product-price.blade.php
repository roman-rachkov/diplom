@props(['dto'])
<div class="Cart-block Cart-block_price">
    @if($dto->sumPricesWithDiscount)
        <div class="Cart-price">
            ${{ $dto->sumPricesWithDiscount }}
        </div>
        <div  class="Cart-price Cart-price_old">
            ${{ $dto->sumPrice }}
        </div>
    @else
        <div class="Cart-price">
            ${{ $dto->sumPrice }}
        </div>
    @endif
</div>
