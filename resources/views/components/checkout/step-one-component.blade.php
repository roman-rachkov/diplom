<div class="Order-block Order-block_OPEN" id="step1">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{__('checkout.step1')}}</h2>
    </header>
    <div class="row">
        <div class="row-block">
            <div class="form-group">
                <label class="form-label" for="name">{{__('checkout.full_name.title')}}</label>
                <input class="form-input" id="name" name="name" type="text"
                       data-validate="require"
                       placeholder="{{__('checkout.full_name.placeholder')}}"
                       value="{{(old('name') ?? auth()->user()?->name) ?? ''}}"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="phone">{{__('checkout.phone.title')}}</label>
                <input class="form-input" id="phone" name="phone" type="text" data-validate="require"
                       placeholder="{{__('checkout.phone.placeholder')}}"
                       value="{{(old('phone') ?? auth()->user()?->phone) ?? ''}}"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="mail">{{__('checkout.mail.title')}}</label>
                <input class="form-input" id="mail" name="mail" type="text"
                       data-validate="require" placeholder="{{__('checkout.mail.placeholder')}}"
                       value="{{(old('mail') ?? auth()->user()?->email) ?? ''}}"/>
            </div>
        </div>
        @guest
            <div class="row-block">
                <div class="form-group">
                    <label class="form-label" for="password">{{__('checkout.password.title')}}</label>
                    <input class="form-input" id="password" name="password" type="password"
                           placeholder="{{__('checkout.password.placeholder')}}"
                           data-validate="require"
                    />
                </div>
                <div class="form-group">
                    <label class="form-label" for="passwordReply">{{__('checkout.password.confirm')}}</label>
                    <input class="form-input" id="passwordReply" name="passwordReply" type="password"
                           placeholder="{{__('checkout.password.confirm_placeholder')}}"
                           data-validate="require"
                    />
                </div>
                <div class="form-group">
                    <a class="btn btn_muted Order-btnReg" href="#">{{__('checkout.registered')}}</a>
                </div>
            </div>
        @endguest
    </div>
    <div class="Order-footer"><a class="btn btn_success Order-next" href="#step2">{{__('checkout.next')}}</a>
    </div>
</div>
