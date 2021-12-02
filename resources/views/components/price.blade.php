@props(['price', 'priceWithDiscount'])

<div class="Card-cost">
    @if($priceWithDiscount)
        <span class="Card-priceOld">
            {{$price }}
        </span>
        <span class="Card-price">
            ${{$priceWithDiscount}}
        </span>
    @else
        <span class="Card-price">
            ${{$price}}
        </span>
    @endif
</div>