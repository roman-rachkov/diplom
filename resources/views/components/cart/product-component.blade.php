@props(['dto'])

<div class="Cart-product" data-link="{{route('cart.update', $dto->product)}}">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{route('product.show', $dto->product)}}">
                <img class="Cart-img"
                     src="{{$dto->product->image->relativeUrl}}"
                     alt="{{$dto->product->name}}"/>
            </a>
        </div>
        <div class="Cart-block Cart-block_info">
            <a class="Cart-title"
               href="{{route('product.show', $dto->product)}}">{{$dto->product->name}}</a>
            <div class="Cart-desc">{{$dto->product->description}}</div>
        </div>
        <x-cart.product-price :dto="$dto"/>
    </div>
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <select class="form-select">
                @foreach($dto->product->sellers as $seller)
                    <option
                        value="{{$seller->id}}"
                        {{$dto->price->seller->is($seller) ? 'selected' : ''}}
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
                    <input class="Amount-input form-input" name="amount" type="text" value="{{$dto->quantity}}"
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
