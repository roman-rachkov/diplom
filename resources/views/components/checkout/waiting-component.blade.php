@props(['paymentId' => null, 'styles'=>null])

<div class="ProgressPayment" data-payment="{{$paymentId}}" style="{{$styles ?? ''}}">
    <div class="ProgressPayment-title default">{{__('payment.wait')}}</div>
    <div class="ProgressPayment-icon">
        <div class="cssload-thecube">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
    </div>

    <div class="ProgressPayment-title progress-status succeeded">{{__('payment.succeeded')}}</div>
    <div class="ProgressPayment-title progress-status canceled">{{__('payment.canceled')}}</div>
    <div class="ProgressPayment-title progress-status pending">{{__('payment.pending')}}</div>

    <p class="payment-error progress-status">{{__('payment.error')}} <span></span></p>

</div>
