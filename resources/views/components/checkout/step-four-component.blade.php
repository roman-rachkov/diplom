<form action="{{route('order.add')}}" method="post">

{{--    @dd(session('order_data'))--}}
    @csrf
    <div class="Order-block Order-block_OPEN" id="step4">
        <header class="Section-header Section-header_sm">
            <h2 class="Section-title">{{__('checkout.step4')}}</h2>
        </header>
        <!--+div.Order.-confirmation-->
        <div class="Order-infoBlock">
            <div class="Order-personal">
                <div class="row">
                    <div class="row-block">
                        <x-info-component :title="__('checkout.full_name.title')">
                            {{$inputs['name']}}
                        </x-info-component>
                        <x-info-component :title="__('checkout.phone.title')">
                            {{ $inputs['phone'] }}
                        </x-info-component>
                        <x-info-component :title="__('checkout.mail.title')">
                            {{ $inputs['email'] }}
                        </x-info-component>
                    </div>
                    <div class="row-block">
                        <x-info-component :title="__('checkout.delivery.type')">
                            {{
                                $inputs['delivery'] == 'express'
                                    ? __('checkout.delivery.express')
                                    : __('checkout.delivery.default')
                            }}
                        </x-info-component>
                        <x-info-component :title="__('checkout.delivery.city')">
                            {{ $inputs['city'] }}
                        </x-info-component>
                        <x-info-component :title="__('checkout.delivery.address')">
                            {{ $inputs['address'] }}
                        </x-info-component>
                        <x-info-component :title="__('checkout.payment.title')">
                            {{ $inputs['payService'] }}
                        </x-info-component>
                    </div>
                </div>
            </div>
            <div class="Cart Cart_order">
                @foreach($cartItemsDTOs as $dto)
                    <x-checkout.product-component :dto="$dto"/>
                @endforeach
                <div class="Cart-total">
                    <x-cart.cart-price
                            :cost="$cartService->getCartCost()"
                            :costWithDiscount="$cartService->getTotalCost()"
                    />
                    <div class="Cart-block">
                        <button class="btn btn_primary btn_lg" type="submit">{{__('checkout.pay')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
