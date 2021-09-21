@props(['minPrice', 'maxPrice', 'sellers', 'request'])
<div class="Section-columnSection">
    <header class="Section-header">
        <strong class="Section-title">{{ __('catalog.filter.filter') }}</strong>
    </header>
    <div class="Section-columnContent">
        <form class="form" action="#" method="get">
            <div class="form-group">
                <div class="range Section-columnRange">
                    <input class="range-line" id="price" type="text" data-type="double"
                           data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}"
                           data-from="{{ $minPrice }}" data-to="2700.75"/>
                    <div class="range-price">{{ __('catalog.filter.price') }}:&#32;
                        <div class="rangePrice"></div>
                    </div>
                </div>
                <input id="minPrice" name="minPriceChoice" value="{{ $minPrice }}" type="hidden">
                <input id="maxPrice" name="maxPriceChoice" value="{{ $maxPrice }}" type="hidden">
            </div>

            <div class="form-group">
                <input class="form-input form-input_full" id="title" name="search" type="text"
                       placeholder="{{ __('catalog.filter.product_title') }}"
                       value="{{ $request->getSearch() ?? '' }}"
                />
            </div>
            <div class="form-group">
                <select name="seller" class="form-select">
                    <option selected="selected" disabled="disabled">{{ __('catalog.filter.seller') }}</option>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="buttons">
                    <button type="submit" class="btn btn_square btn_dark btn_narrow">{{ __('catalog.filter.button') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
