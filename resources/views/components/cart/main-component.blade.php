<div class="Section">
    <div class="wrap">
        @if($cartItemsDTOs->isEmpty())
            <p>{{__('cart.empty')}}</p>
        @else
            <form class="form Cart" action="#" method="post">
                @foreach($cartItemsDTOs as $dto)
                    <x-cart.product-component :dto="$dto"/>
                @endforeach
                <div class="Cart-total">
                    <x-cart.cart-price :cartService="$cartService"/>
                    <div class="Cart-block"><a class="btn btn_success btn_lg" href="{{route('order.index')}}">{{__('cart.checkout')}}</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
