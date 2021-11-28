<?php

namespace App\Service\Imports;

use App\Models\Seller;
use Bukashk0zzz\YmlGenerator\Model\Offer\OfferSimple;
use Bukashk0zzz\YmlGenerator\Model\Category;
use Bukashk0zzz\YmlGenerator\Model\Currency;
use Bukashk0zzz\YmlGenerator\Model\Delivery;
use Bukashk0zzz\YmlGenerator\Model\ShopInfo;
use Bukashk0zzz\YmlGenerator\Settings;
use Bukashk0zzz\YmlGenerator\Generator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category as ModelCategory;
use Illuminate\Support\Facades\Log;

class YmlGenerator
{
    public function makeYml(Seller $seller, $filepath)
    {
        $settings = (new Settings())
            ->setOutputFile($filepath)
            ->setEncoding('UTF-8');

//        $shopsInfos = [];
//
//        $sellers->each(function ($seller) {
//
//            $shopsInfos[] = (new ShopInfo())
//                ->setName($seller->name)
//                ->setCompany($seller->name)
//                ->setEmail($seller->email);
//
//        });

        // Creating ShopInfo object (https://yandex.ru/support/webmaster/goods-prices/technical-requirements.xml#shop)
        $shopInfo = (new ShopInfo())
            ->setName($seller->name)
            ->setCompany($seller->name)
            ->setUrl(route('sellers.show', $seller))
            ->setEmail($seller->email)
        ;

        // Creating currencies array (https://yandex.ru/support/webmaster/goods-prices/technical-requirements.xml#currencies)
        $currencies = [];
        $currencies[] = (new Currency())
            ->setId('USD')
            ->setRate(1)
        ;

        // Creating categories array (https://yandex.ru/support/webmaster/goods-prices/technical-requirements.xml#categories)
        $ymlCategories = [];

        $this->getSellerCategories($seller)->each(function ($category) use (&$ymlCategories){
            $ymlCategories[] = (new Category())
                ->setId($category->id)
                ->setName($category->name)
            ;
        });



        // Creating offers array (https://yandex.ru/support/webmaster/goods-prices/technical-requirements.xml#offers)
        $offers = [];

        $seller->prices->each(function ($price) use (&$offers){
            $offers[] = (new OfferSimple())
                ->setId($price->id)
                ->setAvailable(true)
                ->setUrl(route('product.show', $price->product))
                ->setPrice($price->price)
                ->setCurrencyId('USD')
                ->setCategoryId($price->product->category->id)
                ->setDelivery(true)
                ->setName($price->product->name)
            ;
        });

        // Optional creating deliveries array (https://yandex.ru/support/partnermarket/elements/delivery-options.xml)
        $deliveries = [];
        $deliveries[] = (new Delivery())
            ->setCost(2)
            ->setDays(1)
            ->setOrderBefore(14)
        ;

        (new Generator($settings))->generate(
            $shopInfo,
            $currencies,
            $ymlCategories,
            $offers
        );
    }

    protected function getSellerCategories(Seller $seller)
    {
        return ModelCategory::whereHas(
            'products',
            function ($query) use ($seller) {
                $query->whereHas(
                    'prices',
                    function($query) use ($seller) {
                        $query->where('seller_id', $seller->id);
                    });
            })
            ->get();
    }

}