@props(['item'])
<div class="Cart-product">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{route('product.show', $item->price->product)}}">
                <img class="Cart-img" src="{{$item->price->product->image->relativeUrl}}"
                     alt="{{$item->price->product->name}}"/>
            </a>
        </div>
        <div class="Cart-block Cart-block_info">
            <a class="Cart-title" href="{{route('product.show', $item->price->product)}}">{{$item->price->product->name}}</a>
            <div class="Cart-desc">{{$item->price->product->description}}</div>
        </div>
        <div class="Cart-block Cart-block_price">
            <div class="Cart-price">{{$item->sum}}$</div>
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
