@extends('layout.master')

@section('title', __('payment.waiting').$order->id)

@section('content')
    <div class="Section">
        <div class="wrap">
            <x-checkout.waiting-component :paymentId="$payment->id"/>
        </div>
    </div>
@endsection
