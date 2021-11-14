<?php

namespace Tests\Unit;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Models\Discount;
use App\Models\DiscountGroup;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDiscountRepositoryGetMostWeightySetDiscountMethod(DiscountRepositoryContract $repo)
    {
        //Создать скидку на набор
        $discount = Discount::factory(
            [
                'category_type' => 'set',
                'is_active' => 1,
                'start_at' => Carbon::yesterday(),
                'end_at' => Carbon::tomorrow(),
            ]
        )->create();

        //Создать продукты



        //Создать две группы у скидки
        $discount->discountGroups()->saveMany(
            DiscountGroup::factory()->create(),

        );


        //$repo->getMostWeightySetDiscount();

        $this->assertTrue(true);
    }
}
