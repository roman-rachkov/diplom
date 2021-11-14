<?php

namespace Tests\Unit;

use App\Contracts\Repository\DiscountRepositoryContract;
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
        $repo->getMostWeightySetDiscount();

        $this->assertTrue(true);
    }
}
