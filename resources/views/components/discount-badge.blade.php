@props(['dto'])
@if($dto->priceWithDiscount)
    <div class="Card-sale">
        {{$dto->discountBadgeText}}
    </div>
@endif
