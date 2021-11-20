<?php

namespace App\Repository;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\ComparedProduct;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompareProductsRepository implements CompareProductsRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings, ComparedProduct $comparedProduct)
    {
        $this->adminSettings= $adminSettings;
        $this->model = $comparedProduct;
    }


    public function store(Product $product, Customer $customer): bool
    {
        try {
          return (new ComparedProduct(
                [
                    'product_id' => $product->id,
                    'customer_id' => $customer->id
                ]
            ))->save();
        } catch (QueryException $e) {
            return false;
        }
    }

    public function delete(Product $product, Customer $customer): bool
    {
        return ComparedProduct::where('product_id', $product->id)
            ->where('customer_id', $customer->id)
            ->get()
            ->first()
            ->delete();
    }

    public function getComparedProducts(Customer $customer): null|Collection
    {

        $ttl = $this->adminSettings->get('comparedProductsCacheTime', 60 * 60 * 24);

        return Cache::tags(
            [
                'comparedProducts',
                'customers',
                'products'
            ])
            ->remember(
            'compared_products:customer_id=' . $customer->id,
            $ttl,
            function () use ($customer) {
                return ComparedProduct::select('product_id')
                    ->where('customer_id', $customer->id)
                    ->with(
                        [
                            'product' => function($query)
                            {
                                $query->select('name','id','main_img_id', 'slug', 'category_id')
                                    ->with(
                                        [
                                            'characteristicValues' => function($query)
                                            {
                                                $query->join(
                                                    'characteristics',
                                                    'characteristic_id',
                                                    'characteristics.id'
                                                );
                                            }
                                        ]
                                    )
                                    ->with('image')
                                    ->withCount(
                                        [
                                            'prices as avg_price' => function($query)
                                            {
                                                $query->select(DB::raw('avg(price)'));
                                            }
                                        ])
                                    ->get();
                            }
                        ]
                    )
                    ->get();
            }
        );
    }

    public function chengeCutomerId($customerAuthId, $customerId)
    {
        $itemsCustomerAuth = $this->model->where('customer_id', $customerAuthId)->get()->pluck('product_id');
        $items = $this->model->where('customer_id', $customerId)->get();
        foreach ($items as $item) {
            if (!$itemsCustomerAuth->contains($item->product_id)) {
                $item->update(['customer_id' => $customerAuthId]);
            } else {
                $item->delete();
            }
        }
    }
}
