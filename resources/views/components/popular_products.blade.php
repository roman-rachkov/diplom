<header class="Section-header">
    <h2 class="Section-title">{{$title ?? __('components.top-products')}}</h2>
</header>

<div class="Cards">
    @for($i = 1; $i < 9; $i++)
        <div class="Card"><a class="Card-picture" href="#"><img src="{{asset('assets/img/content/home/card.jpg')}}" alt="card.jpg"/></a>
            <div class="Card-content">
                <strong class="Card-title"><a href="#">Corsair Carbide Series Arctic White Steel</a>
                </strong>
                <div class="Card-description">
                    <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                    </div>
                    <div class="Card-category">Games / xbox
                    </div>
                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="{{asset('assets/img/icons/card/bookmark.svg')}}" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="{{asset('assets/img/icons/card/cart.svg')}}" alt="cart.svg"/></a><a class="Card-btn" href="compare.html"><img src="{{asset('assets/img/icons/card/change.svg')}}" alt="change.svg"/></a>
                    </div>
                </div>
            </div>
            <div class="Card-sale">-60%
            </div>
        </div>
    @endfor
</div>
