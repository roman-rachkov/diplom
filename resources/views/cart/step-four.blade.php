@extends('cart.layout')

@section('title', __('checkout.title'))

@section('sub-content')
    <x-checkout.step-four-component :inputs="$data"/>
@endsection
