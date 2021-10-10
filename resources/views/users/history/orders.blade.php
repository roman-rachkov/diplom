@extends('layout.master')

@section('title', __('account_navigation.order_history'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('users.navigation')

            <div class="Section-content">
                <div class="Orders">
                    @forelse($orders as $order)
                        <x-user.order-history-component :order="$order" :user="$user"/>
                    @empty
                        <p>{{__('profile.orders.noOne')}}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
