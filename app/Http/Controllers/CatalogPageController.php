<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
use Illuminate\Http\Request;

class CatalogPageController extends Controller
{
    public function index(ProductRepositoryContract $repo)
    {
        $products = $repo->getAllProducts();

        return view('catalog', compact('products'));
    }

    public function getByGategory(ProductRepositoryContract $repo, $category)
    {

    }
}
