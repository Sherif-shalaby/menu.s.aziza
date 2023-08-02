<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class PostSitemapController extends Controller
{
    public function index()
    {
        $alphas = range('a', 'z');

        return response()->view('home.sitemap.posts.index', [
            'alphas' => $alphas,
        ])->header('Content-Type', 'text/xml');
    }

    public function show($Products){
        $Products = Product::where('name', 'LIKE', "$Products%")->get();

        return response()->view('home.sitemap.posts.show', [
            'Products' => $Products,
        ])->header('Content-Type', 'text/xml');
    }
}
