<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\SellerRepositoryContract;

class SellerController extends Controller
{
    public $sellerRepository;

    public function __construct(SellerRepositoryContract $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function show($id)
    {
        $seller = $this->sellerRepository->find($id);

        return view('seller.show', compact('seller'));
    }
}
