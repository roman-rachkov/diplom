<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogGetRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index(CatalogGetRequest $request): Factory|View|Application
    {
        return view('main', compact('request'));
    }
}
