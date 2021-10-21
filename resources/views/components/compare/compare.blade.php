@props(['comparedProducts'])

<div class="Section">
    <div class="wrap">
        <div class="Compare">
            <div class="Compare-header">
        <label class="toggle Compare-checkDifferent">
            <input type="checkbox" name="differentFeature" value="true" checked="checked"/><span class="toggle-box"></span><span class="toggle-text">Только различающиеся характеристики</span>
        </label>
    </div>
                {{--    ТОВАРЫ--}}
                <x-compare.compare-products-row :products="$comparedProducts->get('products')"/>

                {{--    ССЫЛКИ--}}
                <x-compare.compare-links-row :products="$comparedProducts->get('products')"/>

                {{--ХАРАКТЕРИСТИКИ--}}
                @foreach($comparedProducts->get('characteristics') as $characteristic)
                    <x-compare.compare-characteristic-row :characteristic="$characteristic"/>
                @endforeach

                {{--ЦЕНА И СКИДКА--}}
                <x-compare.compare-prices-row :products="$comparedProducts->get('products')"/>
        </div>
    </div>
</div>