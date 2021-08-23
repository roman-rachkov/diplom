@extends('layout.master')

@section('content')
        <div class="Section">
            <div class="wrap">

                @include('main.banners_home')

            </div>
        </div>
        <div class="Section Section_column Section_columnLeft Section_columnDesktop">
            <div class="wrap">

                <div class="Section-column">

                    @include('main.limited_deals')

                </div>
                <div class="Section-content">

                    @include('main.popular_products')

                </div>
            </div>
        </div>

        <div class="Section Section_dark">
            <div class="wrap">
                <div class="Section-content">

                    @include('main.hot_offers_slider')

                </div>
            </div>
        </div>
        <div class="Section Section_column Section_columnRight">
            <div class="wrap">
                <div class="Section-column">

                    @include('main.quality_banner')

                </div>
                <div class="Section-content">

                    @include('main.limited_edition_slider')

                </div>
            </div>
        </div>
@endsection
