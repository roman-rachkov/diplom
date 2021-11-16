@extends('layout.master')

@section('title', 'Скидки')

@section('content')
    <div class="Section">
        <div class="wrap">
            <div class="Cards Cards_blog">

                @foreach($discounts as $discount)
                <div class="Card">
                    <a class="Card-picture" href="#">
                        <img src="{{$discount->image->getRelativeUrlAttribute() ?? ''}}" alt="{{$discount->image->alt}}"/>
                    </a>

                    <x-discount.data :discount="$discount"/>

                    <div class="Card-content">
                        <strong class="Card-title"><a href="#">{{ $discount->title }}</a>
                        </strong>
                        <div class="Card-description">{{ $discount->description }}
                        </div>
                    </div>
                </div>
                @endforeach

                {{ $discounts->links('components.pagination') }}

            </div>
        </div>
    </div>
@endsection
