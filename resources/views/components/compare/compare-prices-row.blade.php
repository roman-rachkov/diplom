@props(['products'])

<div class="Compare-row">
    <div class="Compare-title">Цена
    </div>
    <div class="Compare-products">
        @foreach($products as $product)
            <div class="Compare-product">
                <div class="Compare-nameProduct">{{$product->productName}}
                </div>
                <div class="Compare-feature">
                    <strong class="Compare-priceOld">{{$product->getPriceInDollars($product->productAvgPrice)}}
                    </strong>
                    <strong class="Compare-price">{{$product->getPriceInDollars($product->productPriceWithDiscount)}}
                    </strong>
                </div>
            </div>
        @endforeach
    </div>
</div>