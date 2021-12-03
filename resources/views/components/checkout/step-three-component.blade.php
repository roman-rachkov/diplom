<div class="Order-block {{$classes ?? ''}}" id="step3">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{$title ?? __('checkout.step3')}}</h2>
    </header>
    <div class="form-group">
        @foreach($payments as $payment)
            <x-checkout.payment-component :payment="$payment"/>
        @endforeach
    </div>
    <div class="Order-footer">
        <button type="submit" class="btn btn_success btn_lg">{{$button ?? __('checkout.next')}}</button>
    </div>
</div>
