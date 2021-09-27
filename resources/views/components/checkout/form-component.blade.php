<form class="form" id="checkout" action="{{route('order.add')}}" method="post">
    @csrf
    <x-checkout.step-one-component/>
    <x-checkout.step-two-component/>
    <x-checkout.step-three-component/>
    <x-checkout.step-four-component :cart="$cart"/>
</form>

@guest
    <x-modal-component id="loginModal">
        <div class="card">
            <div class="card-body">
                <x-login-component />
            </div>
        </div>
    </x-modal-component>
@endguest
