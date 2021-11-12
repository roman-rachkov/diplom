@props(
    [
        'reviews',
        'dto',
        'discount',
        'reviewsCount'
    ])

<div class="Product">
    <div class="ProductCard">
        <div class="ProductCard-look">
            <div class="ProductCard-photo">
                <x-discount-badge
                        :priceWithDiscount="$dto->priceWithDiscount"
                        :discountBadgeText="$dto->discountBadgeText"
                />
                <img
                        src={{$dto->product->image->getRelativeUrlAttribute()}}
                        alt={{$dto->product->image->alt}}
                />
            </div>
            <x-product.product-item-images
                    :images="$dto->product->attachment"
                    :mainImage="$dto->product->image"
            />
        </div>
        <div class="ProductCard-desc">
            <div class="ProductCard-header">
                <h2 class="ProductCard-title">{{$dto->product->name}}</h2>
                <div class="ProductCard-info">
                    <div class="ProductCard-cost">
                        @if($dto->priceWithDiscount)
                            <div class="ProductCard-price">
                                ${{ $dto->priceWithDiscount }}
                            </div>
                            <div class="ProductCard-priceOld">
                                ${{ $dto->price }}
                            </div>
                        @else
                            <div class="ProductCard-price">
                                ${{ $dto->price }}
                            </div>
                        @endif
                    </div>
                    <form
                            class="ProductCard-compare"
                            method="post"
                            action="{{route('product.addToComparison', $dto->product)}}"
                    >
                        @csrf
                        <button type="submit" class="btn btn_default">
                            <img class="btn-icon"
                                 src={{asset("assets/img/icons/card/change.svg")}}
                                 alt="change.svg"
                            />
                        </button>
                    </form>
                </div>
            </div>
            <div class="ProductCard-text">
                {!! $dto->product->description !!}
            </div>
            <form
                    class="ProductCard-cart"
                    method="post"
                    action="{{route('product.addToCart', $dto->product)}}"
            >
                @csrf
                <div class="ProductCard-cartElement ProductCard-cartElement_amount">
                    <div class="Amount Amount_product">
                        <button class="Amount-remove" type="button"></button>
                        <input class="Amount-input form-input" name="amount" type="text" value="1"/>
                        <button class="Amount-add" type="button"></button>
                    </div>
                </div>
                <div class="ProductCard-cartElement">
                    <button class="btn btn_primary" type="submit" >
                        <img
                                class="btn-icon"
                                src={{asset("assets/img/icons/card/cart_white.svg")}}
                                alt="cart_white.svg"
                        />
                        <span class="btn-content">{{__('product.buy_btn')}}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="Tabs Tabs_default">
        <div class="Tabs-links">
            <a class="Tabs-link_ACTIVE Tabs-link" href="#description">
                <span>{{__('product.tabs_links.description')}}</span>
            </a>
            <a class="Tabs-link" href="#sellers">
                <span>{{__('product.tabs_links.sellers')}}</span>
            </a>
            <a class="Tabs-link" href="#addit">
                <span>{{__('product.tabs_links.addit')}}</span>
            </a>
            <a class="Tabs-link" href="#reviews">
                <span>{{__('product.tabs_links.reviews')}} ({{$reviewsCount}})</span>
            </a>
        </div>
        <div class="Tabs-wrap">
            <div class="Tabs-block" id="description">
                {!! $dto->product->full_description !!}
            </div>
            <x-product.product-item-sellers :product="$dto->product" :prices="$dto->product->prices"/>
            <div class="Tabs-block" id="addit">
                <div class="Product-props">
                    <div class="Product-prop">
                        <strong>Lorem
                        </strong><span> Pfizer</span>
                    </div>
                    <div class="Product-prop">
                        <strong>ipsum
                        </strong><span> Lorem ipsum dolor sit</span>
                    </div>
                    <div class="Product-prop">
                        <strong>dolor sit
                        </strong><span> 5 ans</span>
                    </div>
                    <div class="Product-prop">
                        <strong>psum dolo
                        </strong><span> 2–3 jours</span>
                    </div>
                </div>
            </div>
            <x-review.reviews :reviews="$reviews" :product="$dto->product"/>
        </div>
    </div>
</div>
