@extends('cart.layout')

@section('title', __('checkout.title'))

@section('sub-content')
    <x-checkout.form-component/>
@endsection
