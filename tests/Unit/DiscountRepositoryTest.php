<?php

namespace Tests\Unit;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Models\Customer;
use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        Cache::flush();

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
        $customerId = $this->getCustomerId();
        $setDiscountsIds = $this->repo->getOnSetDiscounts($customerId)->pluck('id');

        Cache::flush();

        $validDiscountAttrs = $this->getValidDiscountAttrs(Discount::CATEGORY_SET, rand(10, 100));
        $validDiscountIds = Discount::factory($validDiscountAttrs)->count(3)->create()->pluck('id');
        $this->createInvalidDiscounts($validDiscountAttrs);

        $diff = $setDiscountsIds
            ->merge($validDiscountIds)
            ->diff(
                $this->repo->getOnSetDiscounts($customerId)->pluck('id')
            );

        $this->assertTrue($diff->isEmpty());

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
        float $validCartCost = null)
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

        foreach ($discountsAttrs as $discountsAttr) {
            Discount::factory(array_merge($validDiscountAttrs, $discountsAttr))->create();
        }
    }
}
