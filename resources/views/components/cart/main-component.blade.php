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
                    <div class="Cart-block Cart-block_total">
                        <strong class="Cart-title">{{__('cart.total')}}:</strong>
{{--                        TODO: нужен метод для возврата суммарной цены со скидкой(некоторые скидки false)--}}
                        <span class="Cart-price">{{$cartItemsDTOs->sum('sumPrice')}}$</span>
                        <span class="Cart-price_old">{{'no_value'}}$</span>
                    </div>
                    <div class="Cart-block"><a class="btn btn_success btn_lg" href="{{route('order.index')}}">{{__('cart.checkout')}}</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
