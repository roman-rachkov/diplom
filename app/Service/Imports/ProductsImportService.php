<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\Contracts\Service\Imports\ProductsImportServiceContract;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

class ProductsImportService implements ProductsImportServiceContract
{
    public function import(DataReaderContract $contract): Collection
    {
        $data = $contract->getData();
        $products = $data->map(function ($item) {
            $product = Product::create([
                'name' => $item->name,
                'slug' => $item->slug,
                'description' => $item->description,
                'full_description' => $item->full_description,
                'category_id' => $item->category_id,
                'manufacturer_id' => $item->manufacturer_id,
                'limited_edition' => $item->limited_edition
            ]);
            $price = Price::create([
                'product_id' => $product->id,
                'seller_id' => $item->seller_id,
                'price' => $item->price
            ]);
            return $product;
        });

        return $products;
    }
}