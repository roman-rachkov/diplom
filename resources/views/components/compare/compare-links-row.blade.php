@props(['products'])

<div class="Compare-row">
    <div class="Compare-title Compare-title_blank">
    </div>
    <div class="Compare-products">
        @foreach($products as $dto)
            <div class="Compare-product">
            <div class="Compare-feature">
                <a
                        type="button"
                        class="Compare-btn AddToCart-btn"
                        href="{{route('catalog.add_to_cart', ['slug' => $dto->product->slug])}}"
                        data-route="{{route('product.addToCart', ['slug' => $dto->product->slug])}}"
                >
                    <img src="{{asset('assets/img/icons/cart.svg')}}" alt="cart.svg"/>
                </a>
                <a
                        type="button"
                        class="Compare-btn RemoveFromComparison-btn"
                        href="{{route('comparison.remove_product', ['productSlug' => $dto->product->slug])}}"
                        data-route="{{route('comparison.remove_product', ['productSlug' => $dto->product->slug])}}"
                >
                    <img src="{{asset('assets/img/icons/card/delete.svg')}}" alt="delete.svg"/>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
