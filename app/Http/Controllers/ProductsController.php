<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ProductRepositoryContract $repository
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show(ProductRepositoryContract $repository,string $slug): Application|Factory|View
    {
        return view('components.product.product-item', ['product' => $repository->find($slug)]);
    }

}
