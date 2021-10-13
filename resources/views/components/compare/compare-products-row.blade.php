@props(['products'])

<div class="Compare-row">
    <div class="Compare-title Compare-title_blank">
    </div>
    <div class="Compare-products">
        @foreach($products as $product)
            <div class="Compare-product">
                <div class="Compare-nameProduct Compare-nameProduct_main">{{$product->productName}}
                </div>
                <div class="Compare-feature"><img class="Compare-pict" src={{$product->productImg->getRelativeUrlAttribute()}} alt={{$product->productImg->alt}}/>
                </div>
            </div>
        @endforeach
    </div>
</div>

