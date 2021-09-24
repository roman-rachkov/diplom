<div class="Order-block" id="step4">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{__('checkout.step4')}}</h2>
    </header>
    <!--+div.Order.-confirmation-->
    <div class="Order-infoBlock">
        <div class="Order-personal">
            <div class="row">
                <div class="row-block">
                    <x-checkout.info-component type="name" :title="__('checkout.full_name.title')" :info="auth()->user()?->name ?? ''"/>
                    <x-checkout.info-component type="phone" :title="__('checkout.phone.title')" info="+7{{auth()->user()?->phone ?? '9999999999'}}"/>
                    <x-checkout.info-component type="mail" :title="__('checkout.mail.title')" :info="auth()->user()?->email ?? ''"/>
                </div>
                <div class="row-block">
                    <x-checkout.info-component type="delivery" :title="__('checkout.delivery.type')" :info="__('checkout.delivery.default')"/>
                    <x-checkout.info-component type="city" :title="__('checkout.delivery.city')" :info="auth()->user()?->city ?? ''"/>
                    <x-checkout.info-component type="address" :title="__('checkout.delivery.address')" :info="auth()->user()?->address ?? ''"/>
                    <x-checkout.info-component type="pay" :title="__('checkout.payment.title')" :info="__('checkout.payment.card')"/>
                </div>
            </div>
        </div>
        <div class="Cart Cart_order">
            @foreach($cart->getItemsList() as $item)
                <x-checkout.product-component :item="$item"/>
            @endforeach
            <div class="Cart-total">
                <div class="Cart-block Cart-block_total">
                    <strong class="Cart-title">Итого:
                    </strong><span class="Cart-price">200.99$</span><span class="Cart-price_old">{{$cart->getTotalCost()}}$</span>
                </div>
                <div class="Cart-block">
                    <button class="btn btn_primary btn_lg" type="submit">{{__('checkout.pay')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
