<div class="Order-block" id="step2">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{__('checkout.step2')}}</h2>
    </header>
    <div class="form-group">
        <div>
            <label class="toggle">
                <input type="radio" name="delivery" value="ordinary" checked="checked"/><span
                    class="toggle-box"></span><span class="toggle-text">{{__('checkout.delivery.default')}}</span>
            </label>
        </div>
        <div>
            <label class="toggle">
                <input type="radio" name="delivery" value="express"/>
                <span class="toggle-box"></span>
                <span class="toggle-text">{{__('checkout.delivery.express')}} ($@settings('deliveryExpress', 500))</span>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="city">{{__('checkout.delivery.city')}}</label>
        <input class="form-input" id="city" name="city" type="text" data-validate="require"/>
    </div>
    <div class="form-group">
        <label class="form-label" for="address">{{__('checkout.delivery.address')}}</label>
        <textarea class="form-textarea" name="address" id="address" data-validate="require"></textarea>
    </div>
    <div class="Order-footer"><a class="btn btn_success Order-next" href="#step3">{{__('checkout.next')}}</a>
    </div>
</div>
