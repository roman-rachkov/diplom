@extends('layout.master')

@section('title', $productPriceDiscountDTO->product->name)

@section('content')
    <x-product.product-item
            :reviews="$reviews"
            :dto="$productPriceDiscountDTO"
            :reviewsCount="$reviewsCount"
    />
@endsection