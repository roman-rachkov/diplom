<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\DiscountRepositoryContract;

class DiscountController extends Controller
{
    private DiscountRepositoryContract $discountRepo;

    public function __construct(DiscountRepositoryContract $discountRepository)
    {
        $this->discountRepo = $discountRepository;
    }

    public function index()
    {
        $discounts = $this->discountRepo->getAllActiveDiscount();

        return view('discount.index', compact('discounts'));
    }
}
