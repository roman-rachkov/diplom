@props(['dto'])

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
            <x-price :price="$dto->price" :priceWithDiscount="$dto->priceWithDiscount" />
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
    </div>
    <x-discount.badge
            :discount="$dto->discount"
    />

</div>
