<div class="Order Order_anons">
    <div class="Order-personal">
        <div class="row">
            <div class="row-block">
                <a class="Order-title" href="{{route('users.order', [$user, $order])}}">
                    {!! __('profile.orders.order', ['id' => $order->id, 'date'=>$order->created_at->format('d.m.Y')]) !!}
                </a>
                @if($showElement)
                    <div class="Account-editLink">
                        <a href="{{ route('users.orders', $user) }}">
                            {{ __('account_navigation.order_history') }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="row-block">
                <x-info-component :title="__('checkout.delivery.type')" classes="Order-info_delivery">
                    {{
                        $order->delivery_type == 'express'
                            ? __('checkout.delivery.express')
                            : __('checkout.delivery.default')
                    }}
                </x-info-component>
                <x-info-component :title="__('checkout.payment.title')" classes="Order-info_pay">
                    {{$order->payment->paymentsService->name ?? ''}}
                </x-info-component>
                <x-info-component :title="__('profile.orders.totalCost')">
                    @if($order->payment?->payed_at != null)
                        <span class="Order-price">{{$order->total}}$</span>
                    @else
                        <span class="Order-price">{{$orderService->getTotalCost()}}$</span>
                    @endif
                </x-info-component>
                <x-info-component :title="__('profile.orders.status')" classes="Order-info_status">
                    @if($order->payment?->payed_at != null)
                        {{__('profile.orders.pay.payed')}}

                    @else
                        {{__('profile.orders.pay.notPayed')}}

                    @endif
                </x-info-component>
                @if(!$showElement)
                    @if($order->payment?->comment !== null)
                        <x-info-component :title="__('profile.orders.pay.error')" classes="Order-info_error">
                            {{
                                $order->payment?->comment ?? ''
                            }}
                        </x-info-component>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

