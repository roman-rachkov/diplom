@props(['cost', 'costWithDiscount'])

<div class="Cart-block Cart-block_total">
    <strong class="Cart-title">
        {{__('cart.total')}}:
    </strong>
    @if ($cost == $costWithDiscount)
        <span class="Cart-price">
            <x-format-price :price="$cost" />
        </span>
    @else
        <span class="Cart-price">
            <x-format-price :price="$costWithDiscount" />
        </span>
        <span class="Cart-price_old">
            <x-format-price :price="$cost" />
        </span>
    @endif
</div>
