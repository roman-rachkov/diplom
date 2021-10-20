@props(['paymentId' => null, 'styles'=>null])

<div class="ProgressPayment" data-payment="{{$paymentId}}" style="{{$styles ?? ''}}">
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
