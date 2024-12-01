<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\ProductClass;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Cart;
use App\Models\DiningTable;

use App\Models\Product;
use App\Models\Store;
use App\Models\Variation;
use App\Utils\CartUtil;
use App\Utils\Util;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $cartUtil;
    protected $commonUtil;

    public function __construct(CartUtil $cartUtil, Util $commonUtil)
    {
        $this->cartUtil = $cartUtil;
        $this->commonUtil = $commonUtil;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $most_demanded_query =
            DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'products.id as product_id',
                'products.name as product_name',
                'products.sell_price as product_price',
                DB::raw('SUM(order_details.quantity) as total_quantity')
            )
            ->groupBy('products.id', 'products.name', 'products.sell_price')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get();

        // Convert stdClass to Product model collection
        $productIds = $most_demanded_query->pluck('product_id');
        $most_demanded = Product::whereIn('id', $productIds)->get();



        $user_id = Session::get('user_id');

        $cart_content = \Cart::session($user_id)->getContent()->sortBy('name');

        $extras = Product::leftjoin('product_classes', 'products.product_class_id', 'product_classes.id')
            ->where('product_classes.name', 'Extras')
            ->where('active', 1)
            ->select('products.*')
            ->get();

        $total = $this->getTotal($user_id);
        $month_array = $this->commonUtil->getMonthsArray();
        $stores = Store::pluck('name', 'id');
        $dining_tables = DiningTable::pluck('name', 'id');


        $homepage_category_carousel = System::getProperty('homepage_category_carousel');
        $categories = ProductClass::orderBy('product_classes.sort')->orderBy('product_classes.created_at', 'desc')->where('status', 1)->where('name', '!=', 'Extras')->get();

        $offers_array = [];

        $offers = Offer::where(function ($q) {
            $q->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->orWhereNull('start_date');
        })->where('status', 1)->get();
        $offers_count = 0;
        $i = 0;
        foreach ($offers as $offer) {
            foreach ($offer->products as $product) {
                $offers_array[$i]['product_id'] = $product->id;
                $offers_array[$i]['image'] = $product->getFirstMediaUrl('product');
                $offers_array[$i]['product_name'] = $product->name;
                $offers_array[$i]['product_details'] = $product->product_details;
                $offers_array[$i]['sell_price'] =  $product->sell_price;
                $offers_array[$i]['discount_price'] =  $product->sell_price - $offer->discount_value;
                $i++;
                $offers_count++;
            }
        }

        return view('home.index')->with(compact(
            'categories',
            'offers_array',
            'offers_count',
            'homepage_category_carousel',
            'most_demanded',
            'stores',
            'extras',
            'total',
            'cart_content',
            'dining_tables',
            'month_array'
        ));
    }

    public function getTotal($user_id)
    {
        $cart_content = \Cart::session($user_id)->getContent();
        $total = 0;
        foreach ($cart_content as $item) {
            $total += $item->price * $item->attributes->quantity;
        }
        return $total;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
