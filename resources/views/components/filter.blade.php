@props(['minPrice', 'maxPrice', 'sellers', 'request'])
<div class="Section-columnSection">
    <header class="Section-header">
        <strong class="Section-title">Фильтр</strong>
    </header>
    <div class="Section-columnContent">
        <form class="form" action="#" method="get">
            <div class="form-group">
                <div class="range Section-columnRange">
                    @dd($request->get('minPriceChoice'))
                    <input class="range-line" id="price" type="text" data-type="double"
                           data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}"
                           data-from="{{ $minPrice }}" data-to="2700.75"/>
                    <div class="range-price">Цена:&#32;
                        <div class="rangePrice"></div>
                    </div>
                </div>
                <input id="minPrice" name="minPriceChoice" value="{{ $minPrice }}" type="hidden">
                <input id="maxPrice" name="maxPriceChoice" value="{{ $maxPrice }}" type="hidden">
            </div>

            <div class="form-group">
                <input class="form-input form-input_full" id="title" name="search" type="text" placeholder="Название"/>
            </div>
            <div class="form-group">
                <select name="seller" class="form-select">
                    <option selected="selected" disabled="disabled">Продавец</option>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="buttons">
                    <button type="submit" class="btn btn_square btn_dark btn_narrow">Применить</button>
                </div>
            </div>
        </form>
    </div>
</div>
