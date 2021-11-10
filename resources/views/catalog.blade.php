@extends('layout.master')

@section('content')
    @include('layout.errors')
    @include('layout.success')
    @dd($productDiscountPriceDTO)
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <div class="Section-column">
                <x-filter :minPrice="$minPrice" :maxPrice="$maxPrice" :sellers="$sellers" :request="$request" />
            </div>
            <div class="Section-content">
                <x-sort :request="$request" />
                <x-catalog :productsDiscountsDTO="$productDiscountPriceDTO" :paginationLink="$paginationLink" />
            </div>
        </div>
    </div>
@endsection
