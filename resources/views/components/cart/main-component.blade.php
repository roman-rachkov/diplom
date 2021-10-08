<div class="Section">
    <div class="wrap">
        @if($cartService->getProductsList()->isEmpty())
            <p>{{__('cart.empty')}}</p>
        @else
            <form class="form Cart" action="#" method="post">
                @foreach($cartService->getItemsList() as $item)
                    <x-cart.product-component :item="$item"></x-cart.product-component>
                @endforeach
                <div class="Cart-total">
                    <div class="Cart-block Cart-block_total">
                        <strong class="Cart-title">{{__('cart.total')}}:
                        </strong><span class="Cart-price">200.99$</span><span class="Cart-price_old">{{$cartService->getTotalCost()}}$</span>
                    </div>
                    <div class="Cart-block"><a class="btn btn_success btn_lg" href="{{route('order.index')}}">{{__('cart.checkout')}}</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
