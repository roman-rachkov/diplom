@props(['products'])

<div class="Compare-row">
    <div class="Compare-title">Цена
    </div>
    <div class="Compare-products">
        @foreach($products as $dto)
            <div class="Compare-product">
                <div class="Compare-nameProduct">{{$dto->product->name}}
                </div>
                <div class="Compare-feature">
                    @if($dto->productPriceWithDiscount)
                        <strong class="Compare-priceOld">

                            <x-format-price :price="$dto->product->avg_price" />
                        </strong>
                        <strong class="Compare-price">
                            <x-format-price :price="$dto->productPriceWithDiscount" />
                        </strong>
                    @else
                        <strong class="Compare-price">
                            <x-format-price :price="$dto->product->avg_price" />
                        </strong>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
