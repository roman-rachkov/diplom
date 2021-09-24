<div class="Order-block" id="step3">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{__('checkout.step3')}}</h2>
    </header>
    <div class="form-group">
        <div>
            <label class="toggle">
                <input type="radio" name="pay" value="online" checked="checked"/>
                <span class="toggle-box"></span><span class="toggle-text">{{__('checkout.payment.card')}}</span>
            </label>
        </div>
        <div>
            <label class="toggle">
                <input type="radio" name="pay" value="someone"/>
                <span class="toggle-box"></span><span class="toggle-text">{{__('checkout.payment.another_card')}}</span>
            </label>
        </div>
    </div>
    <div class="Order-footer"><a class="btn btn_success Order-next" href="#step4">{{__('checkout.next')}}</a>
    </div>
</div>
