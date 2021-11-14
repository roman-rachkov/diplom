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
        $itemOnPage = $this->adminsSettings->get('discountsOnPage', 8);

        $discounts = $this->discountRepo->getAllActiveDiscount();
        $discounts = $discounts->paginate($itemOnPage);

        return view('discount.index', compact('discounts'));
    }
}
