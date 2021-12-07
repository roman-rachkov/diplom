@props(['dto', 'time'])

<div class="Section-columnSection Section-columnSection_mark">
    <header class="Section-columnHeader">
        <strong class="Section-columnTitle">{{ __('components.day_offer') }}</strong>
    </header>
    <div class="Card">
        <a class="Card-picture" href="{{ route('product.show', $dto->product) }}">
            <img src="{{ $dto->product->image->getRelativeUrlAttribute() }}" alt="card.jpg"/>
        </a>
        <div class="Card-content">
            <strong class="Card-title">
                <a href="{{ route('product.show', $dto->product) }}">
                    {{ $dto->product->name }}
                </a>
            </strong>
            <div class="Card-description">
                <x-price :price="$dto->price" :priceWithDiscount="$dto->priceWithDiscount"/>
                <div class="Card-category">{{ $dto->product->category->name }}</div>
                <div class="Card-hover">
                    <a class="Card-btn" href="{{ route('product.show', $dto->product) }}">
                        <img src="{{asset('assets/img/icons/card/bookmark.svg')}}" alt="bookmark.svg"/>
                    </a>
                    <a class="Card-btn" href="{{ route('catalog.add_to_cart', $dto->product) }}">
                        <img src="{{asset('assets/img/icons/card/cart.svg')}}" alt="cart.svg"/>
                    </a>
                    <a class="Card-btn" href="{{ route('catalog.compare', $dto->product) }}">
                        <img src="{{asset('assets/img/icons/card/change.svg')}}" alt="change.svg"/>
                    </a>
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
