@props(['item'])

<div class="Cart-product">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict"><a class="Cart-pict" href="#"><img class="Cart-img"
                                                                                   src="{{$item->price->product->image}}"
                                                                                   alt="{{$item->price->product->name}}"/></a>
        </div>
        <div class="Cart-block Cart-block_info"><a class="Cart-title" href="#">{{$item->price->product->name}}</a>
            <div class="Cart-desc">{{$item->price->product->description}}</div>
        </div>
        <div class="Cart-block Cart-block_price">
            <div class="Cart-price">{{$item->sum}}</div>
        </div>
    </div>
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <!-- - var options = setOptions(items, ['value', 'selected', 'disabled']);-->
            <select class="form-select">
                @foreach($item->price->product->sellers as $seller)
                    <option value="good" selected="{{$seller->id}}">{{$seller->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="Cart-block Cart-block_amount">
            <div class="Cart-amount">
                <div class="Amount">
                    <button class="Amount-remove" type="button">
                    </button>
                    <input class="Amount-input form-input" name="amount" type="text" value="{{$item->quantity}}"/>
                    <button class="Amount-add" type="button">
                    </button>
                </div>
            </div>
        </div>
        <div class="Cart-block Cart-block_delete">
            <a class="Cart-delete" href="{{route('cart.delete', $item)}}">
                <img src="{{asset('assets/img/icons/card/delete.svg')}}" alt="delete.svg"/>
            </a>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteButtons = document.querySelectorAll('.Cart-delete');
                Array.prototype.forEach.call(deleteButtons, function (item) {
                    item.addEventListener('click', function (event) {
                        event.preventDefault();
                        fetch(item.href, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            method: 'DELETE'
                        })
                            .then(response => response.json())
                            .then(json => {
                                if(json.status){
                                    location.reload();
                                }
                            })
                        ;
                    });
                });
            });
        </script>
    @endpush
@endonce
