@extends('layout.master')

@section('title', __('payment.order_payment').$order->id)

@section('content')
    <div class="Section">
        <div class="wrap">
            <form class="form Payment" action="#" method="post">
                <div class="Payment-card">
                    <div class="form-group">
                        <label class="form-label">{{__('')}}</label>
                        <input class="form-input Payment-bill" id="numero1" name="payment_card" type="text"
                               placeholder="9999 9999" data-mask="9999 9999" data-validate="require pay"/>
                    </div>
                    <div class="form-group"><a class="btn btn_success Payment-generate" href="#">{{__('')}}</a></div>
                </div>
                <div class="Payment-pay">
                    <a class="btn btn_primary" href="paymentprogress.html">{{__('payment.pay')}} ${{$order->total}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
