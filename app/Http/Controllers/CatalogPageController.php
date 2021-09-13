<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
use Illuminate\Http\Request;

class CatalogPageController extends Controller
{
    public function index(Request $request)
    {
        return view('catalog');
    }
}
