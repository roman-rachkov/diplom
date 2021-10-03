@extends('layout.master')

@section('title', __('payment.order_payment').$order->id)

@section('content')
    <div class="Section">
        <div class="wrap">
            <form class="form Payment" action="{{route('payment.create')}}" method="post">
                @csrf
                <div class="Payment-card">
                    <div class="form-group">
                        <label class="form-label">{{__('payment.card_number')}}</label>
                        <input class="form-input Payment-bill" id="numero1" name="payment_card" type="text"
                               placeholder="9999 9999" data-mask="9999 9999" data-validate="require pay"/>
                    </div>
                    <div class="form-group"><a class="btn btn_success Payment-generate" href="#">{{__('payment.generate')}}</a></div>
                </div>
                <div class="Payment-pay">
                    <button class="btn btn_primary" type="submit">{{__('payment.pay')}} ${{$order->total}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
