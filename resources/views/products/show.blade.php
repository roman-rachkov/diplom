@extends('layout.master')

@section('title', 'Товар: ' . $product->name)

@section('content')
    <x-product.product-item
            :product="$product"
            :avgPrice="$avgPrice"
            :discount="$discount"
            :avgDiscountPrice="$avgDiscountPrice"
    />
@endsection