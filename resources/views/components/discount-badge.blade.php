@props(['priceWithDiscount', 'discountBadgeText'])
@if($priceWithDiscount)
    <div class="Card-sale">
        {{$discountBadgeText}}
    </div>
@endif
