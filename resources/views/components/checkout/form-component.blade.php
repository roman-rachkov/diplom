<form class="form" id="checkout" action="{{route('order.add')}}" method="post">
    <x-checkout.step-one-component/>
    <x-checkout.step-two-component/>
    <x-checkout.step-three-component/>
    <x-checkout.step-four-component :cart="$cart"/>
</form>
