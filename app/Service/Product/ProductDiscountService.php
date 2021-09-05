<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\ProductDiscountServiceContract;
use Illuminate\Support\Collection;

class ProductDiscountService implements ProductDiscountServiceContract
{
    public function getAllDiscounts(Collection $products): array
    {
       $discounts['products'] = $this->getProductDiscount($products);
       $discounts['groups'] = $this->getGroupDiscount($products);
       $discounts['category'] = $this->getCategoryDiscount($products);

        return $discounts;
    }

    public function getGeneralDiscount(Collection $products): array
    {
        $generalDiscountsOfTypeAsKey = []; //не знаю какая из величин больше понадобится
        $generalDiscountsOfTypeWithoutKey = []; //не знаю какая из величин больше понадобится
        $generalDiscount = []; //единственная выбранная скидка

        $discounts[] = $this->getAllDiscounts($products);

        foreach ($discounts as $key => $discount) {
            $maxDiscount = max($discount);

            $generalDiscountsOfTypeAsKey[$key] = array_filter($discount, function ($item) use ($maxDiscount) {
                return $item == $maxDiscount;
            });

            $generalDiscountsOfTypeWithoutKey = array_merge($generalDiscountsOfTypeWithoutKey, array_filter($discount, function ($item) use ($maxDiscount) {
                return $item == $maxDiscount;
            }));
        }

            $maxDiscount = max($generalDiscountsOfTypeWithoutKey);

            $generalDiscount = array_filter($generalDiscountsOfTypeWithoutKey, function ($item) use ($maxDiscount) {
                return $item == $maxDiscount;
            });

        return $generalDiscount;
    }

    //цену на продукты можно возвращать как число (сумма продуктов со скидкой) или массив в котором может быть сумма товаров со скидкой и без скидки
    public function getPriceWithDiscount(Collection $products): int
    {
        $priceWithoutDiscount = 0;
        $priceWithDiscount = 0;

        //примерный код нахождения суммы товаров
//        foreach ($products as $product) {
//            $priceWithoutDiscount += $product->price;
//        }

        $discount = $this->getGeneralDiscount($products);

        $priceWithDiscount = $priceWithoutDiscount - array_shift($discount);

//        return $priceWithDiscount > 0 ? $priceWithDiscount : 1;
        return 1000;
    }

    protected function getProductDiscount($products): array
    {
        $discounts = [];

        //собираем продукты у которых есть скидка
//        foreach ($products as $product) {
//            $discounts[$product] = $product->discount;
//        }

        return $discounts;
    }

    protected function getGroupDiscount($product): array
    {
        $discounts = [];
        // Получаем все группы продуктов $groups = GroupsProductsForDiscount::all();

        // Ищем в $products существующие группы
//        foreach ($groups as $group) {
//            if (! array_diff($group, $products)) {  //используется что то вроде array_diff
//              $discounts[$group] = $group->discount;
//            }
//        }
        return $discounts;
    }

    protected function getCategoryDiscount($products): array
    {
        $discounts = [];

        // Собираем продукты по категориям $categories = $products->groupBy('categories');
//        foreach ($categories as $category => $value) {
//            $discounts[$category] = $category->discount;
//        }

        return $discounts;
    }

}
