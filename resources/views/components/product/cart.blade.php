@props(['product'])
<div class="Card">
    <a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
    <div class="Card-content">
        <strong class="Card-title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </strong>
        <div class="Card-description">
            <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
            </div>
            <div class="Card-category">{{ $product->category->name }}</div>
            <div class="Card-hover">
                <a class="Card-btn" href="#"><img src="{{asset('assets/img/icons/card/bookmark.svg')}}" alt="bookmark.svg"/></a>
                <a class="Card-btn" href="#"><img src="{{asset('assets/img/icons/card/cart.svg')}}" alt="cart.svg"/></a>
                <a class="Card-btn" href="#"><img src="{{asset('assets/img/icons/card/change.svg')}}" alt="change.svg"/></a>
            </div>
        </div>
    </div>
    <div class="Card-sale">-60%
    </div>
</div>
