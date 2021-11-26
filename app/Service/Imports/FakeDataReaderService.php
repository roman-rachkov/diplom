<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\DTO\ProductImportDTO;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

class FakeDataReaderService implements DataReaderContract
{

    public function getData(): Collection
    {
        $data = Product::factory([
            'category_id' => null,
            'manufacturer_id' => null
        ])
            ->afterMaking(function ($product) {
                $product->manufacturer_id = Manufacturer::all()->random()->id;
                $product->category_id = Category::all()->random()->id;
                return $product;
            })
            ->count(10)
            ->make();

        $DTOCollection = $data->map(function ($item) {
            return ProductImportDTO::create([
                'name' => $item->name,
                'slug' => $item->slug,
                'description' => $item->description,
                'full_description' => $item->full_description,
                'limited_edition' => $item->limited_edition,
                'category_id' => $item->category_id,
                'manufacturer_id' => $item->manufacturer_id,
                'seller_id' => Seller::all()->random()->id,
                'price' => (float)mt_rand(1000, 1000000) / 100,
            ]);
        });
        return $DTOCollection;
    }
}