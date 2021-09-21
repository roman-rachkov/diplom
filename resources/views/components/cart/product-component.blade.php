@props(['item'])

<div class="Cart-product" data-link="{{route('cart.update', $item->price->product)}}">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{route('product.show', $item->price->product)}}">
                <img class="Cart-img"
                     src="{{$item->price->product->image->relativeUrl}}"
                     alt="{{$item->price->product->name}}"/>
            </a>
        </div>
        <div class="Cart-block Cart-block_info">
            <a class="Cart-title"
               href="{{route('product.show', $item->price->product)}}">{{$item->price->product->name}}</a>
            <div class="Cart-desc">{{$item->price->product->description}}</div>
        </div>
        <div class="Cart-block Cart-block_price">
            <div class="Cart-price">{{$item->sum}}</div>
        </div>
    </div>
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <select class="form-select">
                @foreach($item->price->product->sellers as $seller)
                    <option
                        value="{{$seller->id}}"
                        {{$item->price->seller->is($seller) ? 'selected' : ''}}
                    >
                        {{$seller->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="Cart-block Cart-block_amount">
            <div class="Cart-amount">
                <div class="Amount">
                    <button class="Amount-remove" type="button">
                    </button>
                    <input class="Amount-input form-input" name="amount" type="text" value="{{$item->quantity}}"
                           data-validate=""/>
                    <button class="Amount-add" type="button">
                    </button>
                </div>
            </div>
        </div>
        <div class="Cart-block Cart-block_delete">
            <a class="Cart-delete" href="#">
                <img src="{{asset('assets/img/icons/card/delete.svg')}}" alt="delete.svg"/>
            </a>
        </div>
    </div>
</div>
