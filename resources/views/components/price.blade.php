@props(['price', 'priceWithDiscount', 'block' => "Card-cost", 'item' => "Card"])

<div class="{{ $block }}">
    @if($priceWithDiscount)
        <span class="{{ $item }}-priceOld">
            <x-format-price :price="$price" />
        </span>
        <span class="{{ $item }}-price">
            <x-format-price :price="$priceWithDiscount" />
        </span>
    @else
        <span class="{{ $item }}-price">
            <x-format-price :price="$price" />
        </span>
    @endif
</div>
