@extends('layout.master')

@section('content')
    <div class="Section">
        <div class="wrap">

            <form class="form Authorization" action="{{ route('password.email') }}" method="post">
                @include('layout.errors')
                @csrf
                <div class="row">
                    <div class="row-block">
                        <div class="form-group">
                            <label class="form-label" for="email">{{ __('auth.email_title') }}</label>
                            <input class="form-input" id="mail" name="email" type="text" placeholder="{{ __('auth.email_placeholder') }}"/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn_primary" type="submit">{{ __('auth.reset_password') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

