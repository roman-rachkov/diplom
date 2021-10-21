@extends('layout.master')

@section('content')

    <div class="Section Section_column Section_columnLeft Section_columnWide">
        <div class="wrap">

            <x-seller.information :seller="$seller"/>

            <div class="Section-content">
                <div class="row row_verticalCenter row_maxHalf">
                    <div class="row-block">
                        <div class="pict"><img src="{{asset($seller->logo->path)}}" alt="bigGoods.png"/>
                        </div>
                    </div>
                    <div class="row-block">
                        <h2>{{$seller->name}}</h2>
                        <p>
                            {{$seller->description}}
                        </p>
                    </div>
                </div>

                <x-popular_products :title="__('seller.popular-products')"/>

             </div>


        </div>
    </div>

@endsection
