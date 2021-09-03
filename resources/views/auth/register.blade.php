@extends('layout.master')

@section('content')
    <div class="Section">
        <div class="wrap">

            <form class="form Authorization" action="{{ route('register') }}" method="post">
                @include('layout.errors')
                @csrf
                <div class="row">
                    <div class="row-block">
                        <div class="form-group">
                            <label class="form-label" for="name">{{ __('auth.name_title') }}</label>
                            <input class="form-input" id="name" name="name" type="text" placeholder="{{ __('auth.name_placeholder') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">{{ __('auth.email_title') }}</label>
                            <input class="form-input" id="mail" name="email" type="text" placeholder="send@test.test"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">{{ __('auth.password_title') }}</label>
                            <input class="form-input" id="password" name="password" type="password"
                                   placeholder="Выберите пароль"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="passwordReply">{{ __('auth.password_confirm_title') }}</label>
                            <input class="form-input" id="passwordReply" name="password_confirmation" type="password"
                                   placeholder="{{ __('auth.password_confirm_placeholder') }}"/>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="row-block">
                                    <button class="btn btn_primary" type="submit">{{ __('auth.register') }}</button>
                                </div>
                                <div class="row-block">
                                    <a href="{{ route('password.request') }}">{{ __('auth.forgot_password') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

