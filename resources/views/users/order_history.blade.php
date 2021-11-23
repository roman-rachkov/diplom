<div class="Account-group">
    <div class="Account-column Account-column_full">
        <div class="Order Order_anons">
            <div class="Order-personal">
                <div class="row">
                    <div class="row-block"><a class="Order-title" href="{{ route('users.order', [$user, $lastOrder]) }}">Заказ&#32;
                            <span class="Order-numberOrder">№{{ $lastOrder->id }}</span>
                            &#32;от&#32;<span class="Order-dateOrder">{{$lastOrder->created_at->format('d.m.y')}}</span></a>
                        <div class="Account-editLink"><a href="{{ route('users.orders', $user) }}">История заказов</a>
                        </div>
                    </div>
                    <div class="row-block">
                        <div class="Order-info Order-info_delivery">
                            <div class="Order-infoType">{{ __('profile.orders.delivery.type') }}:
                            </div>
                            <div class="Order-infoContent">
                                {{
                                            $lastOrder->delivery_type == 'express'
                                                ? __('checkout.delivery.express')
                                                : __('checkout.delivery.default')
                                        }}
                            </div>
                        </div>
                        <div class="Order-info Order-info_pay">
                            <div class="Order-infoType">{{ __('checkout.payment.title') }}:
                            </div>
                            <div class="Order-infoContent">{{$lastOrder->payment?->paymentsService->name}}
                            </div>
                        </div>
                        <div class="Order-info">
                            <div class="Order-infoType">{{__('cart.total')}}:
                            </div>
                            <div class="Order-infoContent">{{$lastOrder->total}}$
                            </div>
                        </div>
                        <div class="Order-info Order-info_status">
                            <div class="Order-infoType">{{ __('profile.orders.status') }}:
                            </div>
                            <div class="Order-infoContent">@if($lastOrder->payment?->payed_at !== null)
                                    {{__('profile.orders.pay.payed')}}
                                @else
                                    {{__('profile.orders.pay.notPayed')}}

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
