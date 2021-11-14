@extends('layout.master')

@section('title', 'Скидки')

@section('content')
    <div class="Section">
        <div class="wrap">
            <div class="Cards Cards_blog">

                @foreach($discounts as $discount)
                <div class="Card"><a class="Card-picture" href="#"><img src="{{$discount->image->getRelativeUrlAttribute() ?? ''}}" alt="{{$discount->image->alt}}"/></a>
                    @if($discount->start_at)
                    <div class="Card-date">
                        <strong class="Card-date-number">{{ $discount->start_at->format('d') }}
                        </strong><span class="Card-date-month">{{ $discount->start_at->format('M') }}</span>
                    </div>
                    @endif
                    @if($discount->end_at)
                    <div class="Card-date Card-date_to">
                        <strong class="Card-date-number">{{ $discount->end_at->format('d') }}
                        </strong><span class="Card-date-month">{{ $discount->end_at->format('M') }}</span>
                    </div>
                    @endif
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
