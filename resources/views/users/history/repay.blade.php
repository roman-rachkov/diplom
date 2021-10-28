@extends('layout.master')

@section('title', __('checkout.payment.title'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <form action="{{route('order.repay.post', $order)}}" method="post" class="fluid">
                @csrf
                <x-checkout.step-three-component classes="visible fluid" title="{{__('profile.orders.pay.selectMethod')}}" button="{{__('payment.pay')}}"/>
            </form>
        </div>
    </div>
@endsection
