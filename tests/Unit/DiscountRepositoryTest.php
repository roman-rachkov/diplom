<?php

namespace Tests\Unit;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class DiscountRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected DiscountRepositoryContract $repo;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo = $this->app->make(DiscountRepositoryContract::class);
    }

    public function testGetOnCartDiscountMethod()
    {
        $customerId = $this->getCustomerId();
        $productsQty = rand(10,20);
        $cartCost =  $this->faker->randomFloat($nbMaxDecimals = 2, $min = 2000, $max = 10000);

        $onCartDiscount = $this->repo->getOnCartDiscount($customerId, $productsQty, $cartCost);

        $weight = is_null($onCartDiscount) ? 10 : $onCartDiscount->weight;

        $validDiscountAttrs = $this->getValidDiscountAttrs(
            Discount::CATEGORY_CART,
            $weight,
            $productsQty,
            $cartCost
        );
        $validDiscountId = Discount::factory($validDiscountAttrs)->create()->id;

        $this->createInvalidDiscounts($validDiscountAttrs, $productsQty, $cartCost);

        $this->assertEquals(
            $validDiscountId,
            $this->repo->getOnCartDiscount($customerId, $productsQty, $cartCost)->id
        );
    }

    public function testGetOnSetDiscountsMethod()
    {
        $setDiscountsIds = $this->repo->getOnSetDiscounts()->pluck('id');

        $validDiscountAttrs = $this->getValidDiscountAttrs(Discount::CATEGORY_SET, rand(10, 100));
        $validDiscountIds = Discount::factory($validDiscountAttrs)->count(3)->create()->pluck('id');
        $this->createInvalidDiscounts($validDiscountAttrs);

        $diff = $setDiscountsIds
            ->merge($validDiscountIds)
            ->diff(
                $this->repo->getOnSetDiscounts()->pluck('id')
            );

        $this->assertTrue($diff->isEmpty());

    }

    public function testGetProductDiscountMethod()
    {
        $product = Product::factory()->create();
        $category = Category::factory()->create();
        $category->products()->save($product);


        $categoryDiscount = Discount::factory(
            $this->getValidDiscountAttrs(Discount::CATEGORY_OTHER, rand(10, 100))
        )->create();

        $productDiscount = Discount::factory(
            $this->getValidDiscountAttrs(Discount::CATEGORY_OTHER, rand(10, 100))
        )->create();

        $mostWeightyDiscount = collect([$productDiscount, $categoryDiscount])->sortByDesc('weight')->first();

        DiscountGroup::factory(['discount_id' => $productDiscount->id])->create()->products()->save($product);
        DiscountGroup::factory(['discount_id' => $categoryDiscount->id])->create()->categories()->save($category);

        $this->createInvalidDiscounts($this->getValidDiscountAttrs(
            Discount::CATEGORY_OTHER,
            $mostWeightyDiscount->weight
        ))->each(function ($discount) use ($product){
                DiscountGroup::factory(['discount_id' => $discount->id])->create()->save([$product]);
            });

        $this->assertEquals($this->repo->getProductDiscount($product)->id, $mostWeightyDiscount->id);
    }

    protected function getCustomerId()
    {
        return Customer::factory()->create()->id;
    }

    protected function getValidDiscountAttrs(
        string $category,
        int $weight,
        ?int $productsQty = null,
        ?float $cartCost = null
    ): array
    {
        $validDiscountAttrs = [
            'category_type' => $category,
            'is_active' => 1,
            'start_at' => Carbon::now()->subDays(10),
            'end_at' => Carbon::now()->addDays(10),
            'weight' => $weight + 1
        ];

        if(!is_null($productsQty)) {
            $validDiscountAttrs = array_merge(
                $validDiscountAttrs,
                [
                    'minimum_qty' => $productsQty - 1,
                    'maximum_qty' => $productsQty + 1
                ]);
        }

        if(!is_null($cartCost)) {
            $validDiscountAttrs = array_merge(
                $validDiscountAttrs,
                [
                    'minimal_cost' => $cartCost - 1,
                    'maximum_cost' => $cartCost + 1
                ]);
        }
        return $validDiscountAttrs;
    }

    protected function createInvalidDiscounts(
        array $validDiscountAttrs,
        int $validProductsQty = null,
        float $validCartCost = null
    ): Collection
    {
        $weight = $validDiscountAttrs['weight'] + 2;
        $discountsAttrs = [
            'expired' => [
                'start_at' => Carbon::now()->subDays(10),
                'end_at' => Carbon::now()->subDays(5),
                'weight' => $weight
            ],

            'inactive' => [
                'is_active' => 0,
                'weight' => $weight
            ]
        ];

        if(!is_null($validProductsQty)) {
            $discountsAttrs['lessQuantity'] = [
                'minimum_qty' => $validProductsQty - 4,
                'maximum_qty' => $validProductsQty - 1,
                'weight' => $weight
            ];
        }

        if(!is_null($validCartCost)) {
            $discountsAttrs['lessQuantity'] = [
                'minimal_cost' => $validCartCost - 10,
                'maximum_cost' => $validCartCost - 5,
                'weight' => $weight
            ];
        }

        $invalidDiscounts = collect([]);
        foreach ($discountsAttrs as $discountsAttr) {
            $invalidDiscounts->push(Discount::factory(array_merge($validDiscountAttrs, $discountsAttr))->create());
        }

        return $invalidDiscounts;
    }
}
