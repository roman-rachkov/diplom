@extends('layout.master')

@section('headers_content')
    <x-banners.banners-slider/>
@endsection

@section('content')
    <div class="Section">
        <div class="wrap">

            <x-banners_home/>

        </div>
    </div>
    <div class="Section Section_column Section_columnLeft Section_columnDesktop">
        <div class="wrap">

            <div class="Section-column">

                <x-limited_deals :product="$dayOfferProduct" :discount="$dayOfferDiscount" :time="$dayOfferTime"/>

            </div>
            <div class="Section-content">
                <x-top-products-component :products="$topProducts" :discounts="$discounts"/>
            </div>
        </div>
    </div>

    <div class="Section Section_dark">
        <div class="wrap">
            <div class="Section-content">

                <x-hot_offers_slider/>

            </div>
        </div>
    </div>
    <div class="Section Section_column Section_columnRight">
        <div class="wrap">
            <div class="Section-column">

                <x-quality_banner/>

            </div>
            <div class="Section-content">

                <x-limited_edition_slider :products="$limitedEditionProduct" :discounts="$limitedEditionDiscounts"/>

            </div>
        </div>
    </div>
@endsection
