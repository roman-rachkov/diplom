@extends('layout.master')

@section('title', __('checkout.payment.title'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <form action="{{route('order.repay', $order)}}" method="post" class="fluid">
                @csrf
                <x-checkout.step-three-component classes="visible fluid" title="Выберите метод оплаты" button="Оплатить"/>
            </form>
        </div>
    </div>
@endsection
