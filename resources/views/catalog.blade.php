@extends('layout.master')

@section('content')
    @include('layout.errors')
    @include('layout.success')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <div class="Section-column">
{{--                @dd($sellers)--}}
                <x-filter :minPrice="$minPrice" :maxPrice="$maxPrice" :sellers="$sellers" :request="$request" />
            </div>
            <div class="Section-content">
                <x-sort :request="$request" />
                <x-catalog :products="$products" :discounts="$discounts" />
            </div>
        </div>
    </div>
@endsection
