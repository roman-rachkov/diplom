@extends('layout.master')

@section('title', __('payment.order_payment').$order->id)

@section('content')
    <div class="Section">
        <div class="wrap">
            @yield('sub-content')
            <x-checkout.waiting-component styles="display:none;"/>
        </div>
    </div>
@endsection
