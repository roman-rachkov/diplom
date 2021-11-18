@props(['product', 'discount', 'time'])

<div class="Section-columnSection Section-columnSection_mark">
    <header class="Section-columnHeader">
        <strong class="Section-columnTitle">{{ __('components.day_offer') }}</strong>
    </header>
    <div class="Card">
        <a class="Card-picture" href="{{ route('product.show', $product) }}"><img src="{{ $product->image->getRelativeUrlAttribute() }}" alt="card.jpg"/></a>
        <div class="Card-content">
            <strong class="Card-title"><a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
            </strong>
            <div class="Card-description">
                <div class="Card-cost">
                    <span class="Card-priceOld">
                        {{ $product->prices->pluck('price')->avg() }}
                    </span>
                    <span class="Card-price">
                        ${{ $discount }}
                    </span>
                </div>
                <div class="Card-category">{{ $product->category->name }}</div>
                <div class="Card-hover">
                    <a class="Card-btn" href="{{ route('product.show', $product) }}"><img src="{{asset('assets/img/icons/card/bookmark.svg')}}" alt="bookmark.svg"/></a>
                    <a class="Card-btn" href="{{ route('catalog.add_to_cart', $product) }}"><img src="{{asset('assets/img/icons/card/cart.svg')}}" alt="cart.svg"/></a>
                    <a class="Card-btn" href="{{ route('catalog.compare', $product) }}"><img src="{{asset('assets/img/icons/card/change.svg')}}" alt="change.svg"/></a>
                </div>
            </div>
            <div class="CountDown" data-date="{{ $time }}">
                <div class="CountDown-block">
                    <div class="CountDown-wrap">
                        <div class="CountDown-days"></div><span class="CountDown-label">дней</span>
                    </div>
                </div>
                <div class="CountDown-block">
                    <div class="CountDown-wrap">
                        <div class="CountDown-hours"></div><span class="CountDown-label">часов</span>
                    </div>
                </div>
                <div class="CountDown-block">
                    <div class="CountDown-wrap">
                        <div class="CountDown-minutes"></div><span class="CountDown-label">минут</span>
                    </div>
                </div>
                <div class="CountDown-block">
                    <div class="CountDown-wrap">
                        <div class="CountDown-secs"></div><span class="CountDown-label">секунд</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
