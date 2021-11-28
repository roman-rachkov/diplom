@props(['offers'])
<div class="Slider Slider_carousel">
    <header class="Section-header">
        <h2 class="Section-title">Горячие предложения</h2>
        <div class="Section-control">
            <div class="Slider-navigate">
            </div>
        </div>
    </header>
    <div class="Slider-box Cards Cards_hz">

        @foreach($offers as $offer)
        <div class="Slider-item">
            <div class="Slider-content">
                <div class="Card">
                    <a class="Card-picture" href="{{ route('product.show', $offer['product']) }}">
                        <img src="{{ $offer['product']->image->getRelativeUrlAttribute() }}" alt="card.jpg"/>
                    </a>
                    <div class="Card-content">
                        <strong class="Card-title"><a href="#">{{ $offer['product']->name }}</a>
                        </strong>
                        <div class="Card-description">
                            <div class="Card-cost">
                                <span class="Card-priceOld">
                                    {{ sprintf('$%.2f', $offer['product']->prices->pluck('price')->avg()) }}
                                </span>
                                <span class="Card-price">
                                    {{ sprintf('$%.2f', $offer['discount']) }}
                                </span>
                            </div>
                            <div class="Card-category">{{ $offer['product']->category->name }}
                            </div>
                            <div class="Card-hover">
                                <a class="Card-btn" href="{{ route('product.show', $offer['product']) }}"><img src="{{asset('assets/img/icons/card/bookmark.svg')}}" alt="bookmark.svg"/></a>
                                <a class="Card-btn" href="{{ route('catalog.add_to_cart', $offer['product']) }}"><img src="{{asset('assets/img/icons/card/cart.svg')}}" alt="cart.svg"/></a>
                                <a class="Card-btn" href="{{ route('catalog.compare', $offer['product']) }}"><img src="{{asset('assets/img/icons/card/change.svg')}}" alt="change.svg"/></a>
                            </div>
                        </div>
                    </div>
                    <div class="Card-sale">-60%
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
