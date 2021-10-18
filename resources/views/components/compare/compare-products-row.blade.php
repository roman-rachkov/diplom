@props(['products'])

<div class="Compare-row">
    <div class="Compare-title Compare-title_blank">
    </div>
    <div class="Compare-products">
        @foreach($products as $dto)
            <div class="Compare-product">
                <div class="Compare-nameProduct Compare-nameProduct_main">{{$dto->product->name}}
                </div>
                <div class="Compare-feature"><img class="Compare-pict" src={{$dto->product->image->getRelativeUrlAttribute()}} alt={{$dto->product->image->alt}}/>
                </div>
            </div>
        @endforeach
    </div>
</div>

