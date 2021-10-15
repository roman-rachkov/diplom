@props(['products', 'discounts'])

<div class="Slider Slider_carousel">
    <header class="Section-header Section-header_close">
        <h2 class="Section-title">{{ __('components.limited_edition') }}</h2>
        <div class="Section-control">
            <div class="Slider-navigate">
            </div>
        </div>
    </header>
    <div class="Slider-box Cards">
        @foreach($products as $product)
            <div class="Slider-item">
                <x-card :product="$product" :discounts="$discounts"/>
            </div>
        @endforeach
    </div>
</div>
