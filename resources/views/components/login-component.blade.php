@props(['link' => route('login')])
<div class="Section">
    <div class="wrap">
        <form class="form Authorization" action="{{ $link }}" method="post">
            @include('layout.errors')
            @csrf
            <div class="row">
                <div class="row-block">
                    <div class="form-group">
                        <label class="form-label" for="email">{{ __('auth.email_title') }}</label>
                        <input class="form-input" id="email" name="email" type="text" placeholder="{{ __('auth.email_placeholder') }}"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">{{ __('auth.password_title') }}</label>
                        <input class="form-input" id="password" name="password" type="password" placeholder="{{ __('auth.password_placeholder') }}"/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn_primary" type="submit">{{ __('auth.login') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
