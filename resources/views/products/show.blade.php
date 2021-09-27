@extends('layout.master')

@section('title', __('product.title') . ': ' . $product->name)

@section('content')
    <x-product.product-item
            :product="$product"
            :reviews="$reviews"
            :avgPrice="$avgPrice"
            :discount="$discount"
            :avgDiscountPrice="$avgDiscountPrice"
            :reviewsCount="$reviewsCount"
    />
@endsection