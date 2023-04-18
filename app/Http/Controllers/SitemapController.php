<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $Product = Product::orderBy('updated_at', 'desc')->first();

        return response()->view('home.sitemap.index', [
            'Product' => $Product,
        ])->header('Content-Type', 'text/xml');
    }

}
