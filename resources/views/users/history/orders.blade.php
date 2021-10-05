@extends('layout.master')

@section('title', __('account_navigation.order_history'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('users.navigation')

            <div class="Section-content">
                <div class="Orders">
                    <x-user.order-history-component/>
                </div>
            </div>
        </div>
    </div>
@endsection
