@props(['product', 'prices'])

<div class="Tabs-block" id="sellers">
    <div class="Categories Categories_product">
        @foreach($prices as $price)
            <form class="Categories-row" method="post" action="{{route('product.addToCart', ['slug' => $product->slug, 'amount' => 1, 'seller' => $price->seller])}}">
                @csrf
                <div class="Categories-block Categories-block_info">
                    <div class="Categories-info">
                        <a class="" href="{{ route('sellers.show', $price->seller->id) }}">
                            <strong>{{$price->seller->name}}</strong>
                        </a>
                    </div>
                </div>
                <div class="Categories-splitProps">
                </div>
                <div class="Categories-block Categories-price">
                    <strong>${{$price->price}}</strong>
                </div>
                <div class="Categories-block Categories-button">
                    <button class="btn btn_primary"  type="submit">
                        <img class="btn-icon" src={{asset("assets/img/icons/card/cart_white.svg")}} alt="cart_white.svg"/>
                        <span class="btn-content">{{__('product.buy_btn')}}</span>
                    </button>
            </div>
        </form>
        @endforeach
    </div>
</div>
