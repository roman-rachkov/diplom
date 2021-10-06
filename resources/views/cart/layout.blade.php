@extends('layout.master')

@section('title', __('checkout.title'))

@section('content')
    <div class="Section Section_column Section_columnRight Section_columnWide Order">
        <div class="wrap">
            <div class="Section-column">
                <div class="Section-columnSection">
                    <header class="Section-header">
                        <strong class="Section-title">{{__('checkout.progress')}}</strong>
                    </header>
                    <x-checkout.steps-component/>
                </div>
            </div>
            <div class="Section-content">
                @yield('sub-content')
            </div>
        </div>
    </div>
@endsection
