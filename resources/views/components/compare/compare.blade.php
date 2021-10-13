@props(['comparedProducts'])


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
    <div class="Compare-row">
        <div class="Compare-title">Частота процессора
        </div>
        <div class="Compare-products">
            <div class="Compare-product">
                <div class="Compare-nameProduct">Ноутбук SE40302
                </div>
                <div class="Compare-feature">2.2 ГГц
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">1.2 ГГц
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">1.2 ГГц
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">1.2 ГГц
                </div>
            </div>
        </div>
    </div>
    <div class="Compare-row Compare-row_hide">
        <div class="Compare-title">Время зарядки от сети
        </div>
        <div class="Compare-products">
            <div class="Compare-product">
                <div class="Compare-nameProduct">Ноутбук SE40302
                </div>
                <div class="Compare-feature">3 часа
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">3 часа
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">3 часа
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">3 часа
                </div>
            </div>
        </div>
    </div>
    <div class="Compare-row">
        <div class="Compare-title">Время работы от батареи
        </div>
        <div class="Compare-products">
            <div class="Compare-product">
                <div class="Compare-nameProduct">Ноутбук SE40302
                </div>
                <div class="Compare-feature">3 часа
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">8 часов
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">8 часов
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">8 часов
                </div>
            </div>
        </div>
    </div>
    <div class="Compare-row">
        <div class="Compare-title">Разъемы usb
        </div>
        <div class="Compare-products">
            <div class="Compare-product">
                <div class="Compare-nameProduct">Ноутбук SE40302
                </div>
                <div class="Compare-feature">3
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">1
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">1
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">1
                </div>
            </div>
        </div>
    </div>

    {{--ЦЕНА И СКИДКА--}}
    <div class="Compare-row">
        <div class="Compare-title">Цена
        </div>
        <div class="Compare-products">
            <div class="Compare-product">
                <div class="Compare-nameProduct">Ноутбук SE40302
                </div>
                <div class="Compare-feature">
                    <strong class="Compare-priceOld">$115.00
                    </strong>
                    <strong class="Compare-price">$85.00
                    </strong>
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">
                    <strong class="Compare-priceOld">$85.00
                    </strong>
                    <strong class="Compare-price">$50.00
                    </strong>
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">
                    <strong class="Compare-priceOld">$85.00
                    </strong>
                    <strong class="Compare-price">$50.00
                    </strong>
                </div>
            </div>
            <div class="Compare-product">
                <div class="Compare-nameProduct">Планшет Windows A848sls
                </div>
                <div class="Compare-feature">
                    <strong class="Compare-priceOld">$85.00
                    </strong>
                    <strong class="Compare-price">$50.00
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>
