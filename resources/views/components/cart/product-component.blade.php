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

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const headers = {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                };

                //Delete Product
                const deleteButtons = document.querySelectorAll('.Cart-delete');
                Array.prototype.forEach.call(deleteButtons, function (item) {
                    item.addEventListener('click', function (event) {
                        event.preventDefault();
                        fetch(item.closest('[data-link]').dataset.link, {
                            headers: headers,
                            method: 'DELETE'
                        })
                            .then(response => response.json())
                            .then(json => {
                                if (json.status) {
                                    location.reload();
                                }
                            });
                    });
                });

                //Change Seller
                const sellerSelectElements = document.querySelectorAll('.Cart-block_seller .form-select');
                Array.prototype.forEach.call(sellerSelectElements, function (item) {
                    item.addEventListener('change', function (event) {
                        updateProduct(item, {'seller': event.target.value})
                    });
                });

                //Change Seller
                const amountElements = document.querySelectorAll('.Amount');
                Array.prototype.forEach.call(amountElements, function (item) {
                    // console.log(item);
                    Array.prototype.forEach.call(item.querySelectorAll('button'), function (button) {
                        button.addEventListener('click', function () {
                            evt = document.createEvent('HTMLEvents');
                            evt.initEvent("change", false, true)
                            setTimeout(() => item.querySelector('input').dispatchEvent(evt), 0);
                        })
                    });
                    item.querySelector('input').addEventListener('change', function (event) {
                        updateProduct(item, {'quantity': event.target.value});
                    });
                });

                function updateProduct(item, data) {
                    fetch(item.closest('[data-link]').dataset.link, {
                        headers: headers,
                        method: 'PUT',
                        body: JSON.stringify(data),
                    })
                        .then(response => response.json())
                        .then(json => {
                            if (json.status) {
                                location.reload();
                            }
                        });
                }
            });
        </script>
    @endpush
@endonce
