@extends('layout.master')

@section('content')
    <div class="Section">
        <div class="wrap">

            <form class="form Authorization" action="{{ route('password.update') }}" method="post">
                @include('layout.errors')
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="row">
                    <div class="row-block">
                        <div class="form-group">
                            <label class="form-label" for="email">{{ __('auth.email_title') }}</label>
                            <input class="form-input" id="mail" name="email" type="text" value="{{ $request->email }}"/>
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
                            <button class="btn btn_primary" type="submit">{{ __('auth.change_password') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

