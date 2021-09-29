<form class="form" id="checkout" action="{{route('order.confirm')}}" method="post">
    @csrf
    <x-checkout.step-one-component/>
    <x-checkout.step-two-component/>
    <x-checkout.step-three-component/>
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
