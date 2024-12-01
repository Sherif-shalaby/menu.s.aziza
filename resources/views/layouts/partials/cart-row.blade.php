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
<div class="flex pb-8 mt-32">
    <div class="flex-1">
    </div>
    <div class="flex-1 text-center mt-6">

    </div>
    <div class="flex-1 text-right ">
        <a href="#top" class="bg-red text-white font-semibold py-2 px-3 rounded-full mt-10" id="goToTop"><i
                class="fa fa-arrow-up"></i></a>
    </div>
</div>

<div class="text-center mt-6 " style="    display: flex;
position: fixed;
width: 120px;
height: 120px;
bottom: 0;
left: 50%;
transform: translate(-50%,40%);
margin: 0;
box-shadow: 0 0 12px #747d85;
background-color: #fff;
padding-bottom: 40px;
justify-content: center;
align-items: center;
z-index: 1000;
border-radius: 60px;
transition: all .4s;
-webkit-transition: all .4s;
-o-transition: all .4s;
-moz-transition: all .4s;">
    <a href="{{ action('CartController@view') }}" class=" text-center cart_items">
        <button class="text-white font-semibold relative  rounded-full text-2xl" style="height: 70px; width: 70px;">
            <span class="item_count text-cart text-dark absolute left-8 top-5" style="padding-left: 25px;"
                style="margin-top: 2px;">{{ $cart_count }}</span>
            <i class="fas fa-shopping-cart"
                style="color: var(--primary-color-hover); font-size: xx-large;"></i></button>
    </a>
</div>
