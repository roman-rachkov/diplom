@extends('layout.master')

@section('content')
    <div class="Section Section_column Section_columnLeft Section_columnWide">
        <div class="wrap">
            <x-benefits></x-benefits>
            <div class="Section-content">
                <article class="Article">
                    <div class="Article-section">
                        <div class="row row_verticalCenter row_maxHalf">
                            <div class="row-block">
                                <h2>{{__('about.main.about.header')}}</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eutu, pretiumem.
                                </p>
                                <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justotuio, rhoncus ut loret, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus element semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae  ligula eget dolor. Aenean massa. Cumtipsu sociis natoque pena tibusetm t semper ni.
                                </p>
                                <div><a class="btn btn_primary" href="{{route('products.index')}}">{{__('about.main.about.button')}}</a></div>
                            </div>
                            <div class="row-block">
                                <div class="pict"><img src="{{asset('assets/img/content/home/slider.png')}}" alt="slider.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Article-section">
                        <div class="row row_verticalCenter row_maxHalf">
                            <div class="row-block">
                                <div class="pict"><img src="{{asset('assets/img/content/home/bigGoods.png')}}" alt="bigGoods.png"/>
                                </div>
                            </div>
                            <div class="row-block">
                                <h2>{{__('about.main.history.header')}}</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eutu, pretiumem.
                                </p>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet, consectetuer
                                    </li>
                                    <li>adipiscing elit doli. Aenean commodo ligula
                                    </li>
                                    <li>eget dolor. Aenean massa. Cumtipsu sociis
                                    </li>
                                    <li>natoque penatibus et magnis dis parturient
                                    </li>
                                    <li>montesti, nascetur ridiculus mus. Donec
                                    </li>
                                    <li>quam felis, ultricies nec, pellentesque eutu
                                    </li>
                                </ul>
                                <div><a class="btn btn_primary" href="{{route('products.index')}}">{{__('about.main.history.button')}}</a></div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>

@endsection
