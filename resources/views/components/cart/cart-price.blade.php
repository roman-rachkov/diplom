@props(['cartService'])

<div class="Cart-block Cart-block_total">
    <strong class="Cart-title">
        {{__('cart.total')}}:
    </strong>
    @if ($cartService->getCartCost() == $cartService->getTotalCost())
        <span class="Cart-price">
            <x-format-price :price="$cartService->getCartCost()" />
        </span>
    @else
        <span class="Cart-price">
            <x-format-price :price="$cartService->getTotalCost()" />
        </span>
        <span class="Cart-price_old">
            <x-format-price :price="$cartService->getCartCost()" />
        </span>
    @endif
</div>
