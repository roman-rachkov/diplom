@props(['item'])
<div class="Cart-product">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{route('product.show', $item->product)}}">
                <img class="Cart-img" src="{{$item->product->image->relative_url}}" alt="{{$item->product->name}}"/>
            </a>
        </div>
        <div class="Cart-block Cart-block_info">
            <a class="Cart-title" href="{{route('product.show', $item->product)}}">{{$item->product->name}}</a>
            <div class="Cart-desc">
                {{$item->product->description}}
            </div>
        </div>
        <div class="Cart-block Cart-block_price">
            <div class="Cart-price_old">{{$item->price->price}}$</div>
            <div class="Cart-price">40.99$</div>
        </div>
    </div>
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <div>{{__('checkout.seller')}}:</div>
            <div>{{$item->price->seller->name}}</div>
        </div>
        <div class="Cart-block Cart-block_amount">{{$item->quantity}} {{__('checkout.qty')}}</div>
    </div>
</div>
