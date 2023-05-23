@php
$user_id = request()
    ->session()
    ->get('user_id');
$cart_count = 0;
if (!empty($user_id)) {
    $cart_collection = Cart::session($user_id)->getContent();
    $cart_count = $cart_collection->count();
}
@endphp
<div class="flex">

    <div class="flex-1 text-center mt-2 ml-1 mr-1 cart_items">
        <a href="{{ action('CartController@view') }}" class=" text-center">
            <button class="bg10 text-white font-semibold relative  rounded-xl w-full flex-c-m"
                style="    height: 50px;
    padding: 5px;
    width: 100%;
    min-width: fit-content;
    font-size: 13px;">

                    <p class="p-lr-5"> @lang('lang.view_cart')</p>
                    <i class="fa fa-lg fa-shopping-cart icon-header-noti" data-notify="{{ $cart_count }}"></i>

            </button>
        </a>
    </div>
</div>
