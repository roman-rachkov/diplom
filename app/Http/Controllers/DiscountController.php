<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;

class DiscountController extends Controller
{
    private DiscountRepositoryContract $discountRepo;
    private AdminSettingsServiceContract $adminsSettings;

    public function __construct(
        DiscountRepositoryContract $discountRepository,
        AdminSettingsServiceContract $adminsSettings
    )
    {
        $this->discountRepo = $discountRepository;
        $this->adminsSettings = $adminsSettings;
    }

    public function index()
    {

        $discounts = $this->discountRepo->getAllActiveDiscount();

        return view('discount.index', compact('discounts'));
    }
}
