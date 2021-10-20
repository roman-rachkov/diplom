@extends('layout.master')

@section('title', __('view_history.history'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">

            @include('users.navigation')

            <div class="Section-content">
                <div class="Cards">
                    @foreach($arrayProductsWithDiscount['products'] as $product)
                        <x-card :product="$product" :discounts="$arrayProductsWithDiscount['discounts']"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
