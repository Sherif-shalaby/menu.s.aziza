@php
use App\Models\Cart;
use App\Models\DiningTable;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Store;
$user_id = Session::get('user_id');
$cart_content = \Cart::session($user_id)->getContent()->sortBy('name');
$extras = Product::leftjoin('product_classes', 'products.product_class_id', 'product_classes.id')
    ->where('product_classes.name', 'Extras')
    ->where('active', 1)
    ->select('products.*')
    ->get();

$total = \Cart::session($user_id)->getTotal();
$stores = Store::pluck('name', 'id');
$dining_tables = DiningTable::pluck('name', 'id');
@endphp


<div class="w-full footer " style="border-top: 1px #85838386 solid">
    <div class="mx-auto ">
        <div class="flex flex-row" style="justify-content: space-between;">

            <div class="w-1/4 text-center md:block" style="width: 27% !important;">
                @include('layouts.partials.cart-row')
            </div>
            <div class="w-1/4 text-center md:block xs:hidden">
            </div>
            <div class="w-1/4 text-right"  style="width: 20% !important;">
                <div class="flex-col mt-2 ">

                    <img src="{{ images_asset(asset('uploads/' . session('logo'))) }}" alt="logo" >


                </div>
            </div>
            <div class="w-1/4 text-center md:block xs:hidden">

            </div>
            <div class="w-1/4 text-left total">
                <span class="w-full h-10 mt-4 rounded-lg cl2 mtext-102">@lang('lang.total')  </span> <br>
                <span class="w-full h-10 mt-4 rounded-lg cl2 mtext-102">{{ @num_format($total) }}
                    {{ session('currency')['code'] }}</span>
            </div>

        </div>
    </div>

    <hr>
    <div class="flex w-full p-b-10">
        <div class="flex-1 mt-8" style="font-size: small;">
            <p class="text-center cl2">
                <a class="cl11" href="{{ action('AboutUsController@index') }}">
                    {{ App\Models\System::getProperty('about_us_footer') }}
                </a> <br><br>
            </p>
            <p class="text-center text-dark">
                <a href="{{ action('AboutUsController@index') }}"
                    class="px-4 py-2 font-bold text-white border-2 border-white rounded-lg bg11 md:text-base xs:text-sm">@lang('lang.show_more')
                </a>
            </p>
        </div>
    </div>

    <div class="flex w-full p-b-10">
        <div class="flex-1 mt-8" style="font-size: small;">
            <p class="text-center cl2">@lang('lang.footer_copyright')</p>
            <p class="text-center text-dark">Tel : 00905386531059 - 0097433231457</p>
        </div>
    </div>
</div>
