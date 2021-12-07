@props(['dto'])
<div class="Cart-product">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{route('product.show', $dto->product)}}">
                <img class="Cart-img" src="{{$dto->product->image->relative_url}}" alt="{{$dto->product->name}}"/>
            </a>
        </div>
        <div class="Cart-block Cart-block_info">
            <a class="Cart-title" href="{{route('product.show', $dto->product)}}">{{$dto->product->name}}</a>
            <div class="Cart-desc">
                {{$dto->product->description}}
            </div>
        </div>
        <x-cart.product-price :dto="$dto"/>
    </div>
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <div>{{__('checkout.seller')}}:</div>
            <div>{{$dto->price->seller->name}}</div>
        </div>
        <div class="Cart-block Cart-block_amount">{{$dto->quantity}} {{__('checkout.qty')}}</div>
    </div>
</div>
