<div class="Order-block" id="step3">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{__('checkout.step3')}}</h2>
    </header>
    <div class="form-group">
        @foreach($payments as $payment)
            <x-checkout.payment-component :payment="$payment"/>
        @endforeach
    </div>
    <div class="Order-footer">
{{--        <a class="btn btn_success Order-next" href="#step4">{{__('checkout.next')}}</a>--}}
        <button type="submit" class="btn btn_success btn_lg">{{__('checkout.next')}}</button>
    </div>
</div>
