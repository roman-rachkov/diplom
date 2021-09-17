<div class="Section">
    <div class="wrap">
        @if($cartService->getProductsList()->isEmpty())
            <p>{{__('cart.empty')}}</p>
        @else
            <form class="form Cart" action="#" method="post">
                @foreach($cartService->getProductsList() as $item)
                    <x-cart.product-component :item="$item"></x-cart.product-component>
                @endforeach
                <div class="Cart-total">
                    <div class="Cart-block Cart-block_total">
                        <strong class="Cart-title">Итого:
                        </strong><span class="Cart-price">200.99$</span><span class="Cart-price_old">250.99$</span>
                    </div>
                    <div class="Cart-block"><a class="btn btn_success btn_lg" href="order.html">Оформить заказ</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
