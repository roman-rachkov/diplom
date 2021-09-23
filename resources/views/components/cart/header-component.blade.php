<a class="CartBlock-block" href="{{route('cart.index')}}">
    <img class="CartBlock-img" src="{{asset('assets/img/icons/cart.svg')}}" alt="cart.svg"/>
    <span class="CartBlock-amount">{{$cart->getProductsQuantity()}}</span>
</a>
<div class="CartBlock-block">
    <span class="CartBlock-price">{{$cart->getTotalCost()}}$</span>
</div>
