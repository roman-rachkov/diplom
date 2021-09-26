<form class="form" id="checkout" action="{{route('order.add')}}" method="post">
    @csrf
    <x-checkout.step-one-component/>
    <x-checkout.step-two-component/>
    <x-checkout.step-three-component/>
    <x-checkout.step-four-component :cart="$cart"/>
</form>

@guest
    <x-modal-component id="loginModal">
        <x-login-component :link="route('order.login')"/>
    </x-modal-component>
@endguest
