<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use LireinCore\YMLParser\YML;
use Symfony\Component\HttpFoundation\File\File;

class YmlDataReaderService implements DataReaderContract
{

    public function __construct(private File $file)
    {}

    public function getData(): Collection
    {
        $yml = new YML();

        try {
            $yml->parse($this->file->getRealPath());
            $date = $yml->getDate();
            $shop = $yml->getShop();
            if ($shop->isValid()) {
                $offersCount = $shop->getOffersCount();
                $shopData = $shop->getData();
                //...
//                foreach ($yml->getOffers() as $offer) {
//                    if ($offer->isValid()) {
//                        $offerCategoryHierarchy = $shop->getCategoryHierarchy($offer->getCategoryId());
//                        $offerData = $offer->getData();
//                        //...
//                    } else {
//                        var_dump($offer->getErrors());
//                        //...
//                    }
//                }
            } else {
                var_dump($shop->getErrors());
                //...
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            //...
        }

        return collect(
            [
                'date' => $date,
                'shop' => $shop,
                'offers' => $offersCount,
                'shop_data' => $shopData,
            ]);
    }
}