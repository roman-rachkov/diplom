@extends('layout.master')

@section('title', __('payment.waiting').$order->id)

@section('content')
    <div class="Section" data-payment="{{$order->payment->id}}">
        <div class="wrap">
            <div class="ProgressPayment">
                <div class="ProgressPayment-title">{{__('payment.wait')}}</div>
                <div class="ProgressPayment-icon">
                    <div class="cssload-thecube">
                        <div class="cssload-cube cssload-c1"></div>
                        <div class="cssload-cube cssload-c2"></div>
                        <div class="cssload-cube cssload-c4"></div>
                        <div class="cssload-cube cssload-c3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
