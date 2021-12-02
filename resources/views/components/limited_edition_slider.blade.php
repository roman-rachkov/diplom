@props(['productPriceDiscountDTO'])

<div class="Slider Slider_carousel">
    <header class="Section-header Section-header_close">
        <h2 class="Section-title">{{ __('components.limited_edition') }}</h2>
        <div class="Section-control">
            <div class="Slider-navigate">
            </div>
        </div>
    </header>
    <div class="Slider-box Cards">
        @foreach($productPriceDiscountDTO as $dto)
            <div class="Slider-item">
                <x-card :dto="$dto"/>
            </div>
        @endforeach
    </div>
</div>
