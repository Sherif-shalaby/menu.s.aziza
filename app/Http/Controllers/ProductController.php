<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductClass;
use Illuminate\Http\Request;


use App\Models\Cart;
use App\Models\DiningTable;
use App\Models\Store;
use App\Models\Variation;
use App\Utils\CartUtil;
use App\Utils\Util;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
    public function getProductListByCategory($category_id)
    {
        $category = ProductClass::find($category_id);
        $products = Product::where('product_class_id', $category_id)->where('active', 1)->orderBy('products.sort')->orderBy('products.created_at', 'desc')->where(function ($query) {
            if (env('ENABLE_POS_SYNC')) {
                $query->where('is_raw_material', 0);
                $query->whereNull('deleted_at');
                $query->where('menu_active', 1);
            } else {
                $query->where('active', 1);
            }
        })->get();

        $categories = ProductClass::orderBy('product_classes.sort')->orderBy('product_classes.created_at', 'desc')->where('status', 1)->where('name', '!=', 'Extras')->get();

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

        return view('product.index')->with(compact(
            'category',
            'categories',
            'products',
            'stores',
            'extras',
            'total',
            'cart_content',
            'dining_tables',
            'month_array'
        ));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $product = Product::findOrFail($id);

        $categories = ProductClass::orderBy('product_classes.sort')->orderBy('product_classes.created_at', 'desc')->where('status', 1)->where('name', '!=', 'Extras')->get();

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


        return view('product.show')->with(compact(
            'product',
            'categories',

            'stores',
            'extras',
            'total',
            'cart_content',
            'dining_tables',
            'month_array'
        ));
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

    public function getPromotionProducts()
    {

        $offers = Offer::whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->where('status', 1)->get();
        $i = 0;
        $offers_array = [];
        foreach ($offers as $offer) {
            foreach ($offer->products as $product) {
                $offers_array[$i]['product_id'] = $product->id;
                $offers_array[$i]['image'] = $product->getFirstMediaUrl('product');
                $offers_array[$i]['product_name'] = $product->name;
                $offers_array[$i]['product_details'] = $product->product_details;
                $offers_array[$i]['sell_price'] =  $product->sell_price;
                $offers_array[$i]['discount_price'] =  $product->sell_price - $offer->discount_value;
                $i++;
            }
        }

        return view('product.promotions')->with(compact(
            'offers_array'
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
}
