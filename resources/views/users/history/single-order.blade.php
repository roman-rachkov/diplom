@extends('layout.master')

@section('title', __('account_navigation.order_history'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('users.navigation')

            <div class="Section-content">
                <div class="Orders">
                </div>
                <div class="Order">
                    <div class="Order-infoBlock">
                        <div class="Order-personal">
                            <div class="row">
                                <div class="row-block">
                                    <x-info-component classes="Order-info_date" :title="__('profile.orders.created')">
                                        {{$order->created_at->format('d.m.y')}}
                                    </x-info-component>
                                    <x-info-component :title="__('profile.fio')">
                                        {{$order->full_name}}
                                    </x-info-component>
                                    <x-info-component :title="__('profile.phone')">
                                        {{$order->phone}}
                                    </x-info-component>
                                    <x-info-component :title="__('profile.email')">
                                        {{$order->email}}
                                    </x-info-component>
                                </div>
                                <div class="row-block">
                                    <x-info-component classes="Order-info_delivery"
                                                      :title="__('profile.orders.delivery.type')">
                                        {{
                                            $order->delivery_type == 'express'
                                                ? __('checkout.delivery.express')
                                                : __('checkout.delivery.default')
                                        }}
                                    </x-info-component>
                                    <x-info-component :title="__('checkout.delivery.city')">
                                        {{$order->city}}
                                    </x-info-component>
                                    <x-info-component :title="__('checkout.delivery.address')">
                                        {{$order->address}}
                                    </x-info-component>
                                    <x-info-component classes="Order-info_pay" :title="__('checkout.payment.title')">
                                        {{$order->payment?->paymentsService->name}}
                                    </x-info-component>
                                    <x-info-component :title="__('profile.orders.status')" classes="Order-info_status">
                                        @if($order->payment?->payed_at !== null)
                                            {{__('profile.orders.pay.payed')}}
                                        @else
                                            {{__('profile.orders.pay.notPayed')}}

                                        @endif
                                    </x-info-component>
                                    @if($order->payment?->comment !== null)
                                        <x-info-component :title="__('profile.orders.pay.error')"
                                                          classes="Order-info_error">
                                            {{
                                                $order->payment?->comment ?? ''
                                            }}
                                        </x-info-component>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="Cart Cart_order">
                            @foreach($orderItemsDTOs as $dto)
                                <x-user.order-history-product-component :dto="$dto"/>
                            @endforeach
                            <div class="Cart-total">
                                <x-cart.cart-price
                                        :cost="$orderService->getCartCost()"
                                        :costWithDiscount="$orderService->getTotalCost()"
                                />
                                @if($order->payment?->payed_at === null)
                                    <div class="Cart-block">
                                        <a class="btn btn_primary btn_lg" href="{{route('order.repay', $order)}}">{{__('payment.pay')}}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
