@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
@section('content')

   {{-- <div class="container mx-auto">
        <div class="flex">
            <div class="flex-1">
                <div class="w-1/2 h-10 mx-auto -mt-5 text-center text-white bg-red rounded-xl">
                    <h3 class="py-1 text-2xl font-semibold text-white">@lang('lang.categories')</h3>
                </div>
            </div>
        </div>
    </div> --}}
    <script>

        function filterSelection(class_id) {

            if(class_id != 'all'){
                $(".filterDiv").addClass('hide');
                $(".filterDiv-"+class_id).removeClass('hide');
            }else{
                $(".filterDiv").removeClass('hide');
            }
        }

        function w3AddClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
          }
        }

        function w3RemoveClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
              arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
          }
          element.className = arr1.join(" ");
        }

        // Add active class to the current button (highlight it)
        var btnContainer = document.getElementById("myBtnContainer");
        var btns = btnContainer.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function(){
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
          });
        }
        </script>
<style>
    .filterDiv {
      margin: 2px;

    }
    .hide{
        display: none;
    }
    .show {
      display: block;
    }

    .main-cat-style{
        position: relative;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        max-width: 250px;
        height: 100%;
        min-height: 50px;
        margin-left: 30px;
        padding-right: 10px;
        padding-left: 10px;
        background: rgb(255, 255, 255);
        transition: all 0.3s ease 0s;
        color: rgb(65, 75, 92);
    }

    .main-cat-img{
        transition: all 0.3s ease 0s;
        position: absolute;
        border-radius: 8px;
        right: -20px;
        width: 70px;
        max-width: 70px;
        max-height: 70px;
        height: 130%;
        max-height: 130% !important;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.1) -7px 5px 7px;
        overflow: hidden;
    }
    .f-me{
        display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-content: space-around;
    align-items: center;
    }
    .img-s{
    border: #927c40 2px solid;
    border-radius: 10px;
    }

    @media (max-width: 450px) {
        .flex{
            flex-direction: column;
        }
        .w-8{
            width: 1.5rem;
        }

        .h-8{
            height: 1.5rem;
        }
    }
</style>
    <div class="mx-auto my-m-0 container-fluid m-t-80" style="background-image: url('{{ asset('images/test.jpg') }}')">
        <div class="p-tb-5 " style="overflow-x: scroll;">
            <!-- Search product -->
            <div class="flex-w flex-sb-m ">
                <div class=" filter-tope-group m-tb-10" style="display: flex;">
                    <button class="m-2 stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1 main-cat-style boxshadow"  onclick="filterSelection('all')" >
                       @lang('lang.all_product')
                    </button>
                    @foreach ($categories as $category)
                        <button class="m-4 rounded stext-106 cl4 hov1 bor3 trans-04 m-r-4 m-tb-5 logo main-cat-style boxshadow"  onclick="filterSelection({{$category->id}})" >
                            <div class="p-tb-3 logo">
                                <img class="main-cat-img"
                                src="{{images_asset($category->getFirstMediaUrl('product_class')) }}" alt="">
                                <span>  {{ $category->name }}</span>
                            </div>
                        </button>

                    @endforeach
                </div>

            </div>
            <!-- Filter -->
        </div>
    </div>

    <div class="container mx-auto mt-14" style="min-height: 100vh;">
        <div class="w-full mx-auto ">
            <div class=" md:mt-12 xs:mt-6 row" >
                @foreach ($products as $product)
                <div class="col-6 col-md-3 w-full  m-0 mb-5 filterDiv product filterDiv-{{$product->product_class_id}} " id="product">
                    <div class="relative w-full bg-center bg-no-repeat bg-cover shadow-lg pb-full rounded-xl product_card img-s"
                        style="box-shadow: rgba(0, 0, 0, 0.2) -7px 5px 7px;
                        background-image: url('{{images_asset($product->getFirstMediaUrl('product')) }}')">
                    </div>
                    @php
                        $variation_products='';
                        if($product->variations->where('name','!=','Default')->count()>0){
                            $variation_products=$product->variations->where('name','!=','Default');
                        }else{
                            $variation_products=$product->variations->where('name','Default');
                        }

                    @endphp
                    <div class="flex p-2 productCard bg0 " style="flex-wrap: nowrap;justify-content: space-between;align-items: center;height:80px">
                        @foreach($product->variations as $size)
                            <input type="hidden" value="{{$size->size_id}}" name="size"/>
                            <input type="hidden" value="{{$size->id}}" name="variation"/>
                            @break
                        @endforeach
                        {{-- @if(count($product->sizes)>0) --}}

                        @foreach($product->variations as $s)
                        <div class="">
                            <div class="productName">
                                <a href="{{ action('ProductController@show', $product->id) }}"
                                    class="w-full mt-2 text-xs text-center bg-white cl2 opacity-70 rounded-xl d-flex"
                                    style="box-shadow: rgba(0, 0, 0, 0.2) -7px 5px 7px; text-align: start !important;  flex-wrap: wrap;">
                                    <p class="px-1 py-0 font-semibold cl2 font-sm">{{ Str::limit($product->name, 25) }}</p>
                                    <p class="px-1 py-0 font-semibold cl2 font-sm">
                                        {{ session('currency')['code'] }}
                                        <span class="sell-price">
                                        {{ @num_format($s->default_sell_price - $product->discount_value) }}
                                        </span>
                                    </p>
                                </a>
                                <div class="pt-2  f-me">
                            <div class="flex flex-row mb-2">
                                <button
                                    class="w-8 h-8 text-lg text-center rounded-full minus border-gold cl0 bg11">-</button>
                                <input type="quantity" value="1" name="quantity"
                                    class="text-center bg-transparent quantityp quantity focus:outline-none text-dark " style="width: 3.4rem;">
                                <button
                                    class="w-8 h-8 text-lg text-center rounded-full plus border-gold cl0 bg11">+</button>
                            </div>
                            <div class="flex mb-4">

                                @foreach($variation_products as $var)
                                <a data-variation_id="{{ $var->id }}"
                                    class="px-4 py-2 font-semibold text-white rounded-25 cart_button bg11">
                                    <i class="fa md:text-sm xs:text-sm fa-cart-plus cart_icon"></i></a>
                                @break
                                @endforeach
                                </div>
                        </div>
                            </div>
{{--                            <div>--}}
{{--                                <button id="selected"  disabled class="inline-flex items-center p-1 text-center bg-gray-900 rounded-lg size-menu size-btn hover:bg-white focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" >--}}
{{--                                    {{$s->size->name}}<button>--}}
{{--                            </div>--}}
                            <div>
                                @if($s->size_id!==null)
                                    <ul id="dropdownMenuIconHorizontalButton">
                                        @foreach($product->variations as $size)
                                            <li>
                                                <button id="sizes"  data-size_id="{{$size->size_id}}" data-variation_id="{{$size->id}}"  data-size_name="{{$size->size->name}}" data-price="{{ @num_format($size->default_sell_price - $product->discount_value) }}"
                                                        class="inline-flex items-center p-1 text-center text-white bg-gray-900 rounded-lg changeSize bg11 size-btn hover:bg-white focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                                    {{$size->size->name}}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
{{--                                <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal{{$product->id}}" class="inline-flex items-center p-1 text-center text-white bg-gray-900 rounded-lg bg11 size-btn hover:bg-white focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">--}}
{{--                                    <span>--}}
{{--                                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>--}}
{{--                                    </span>--}}
{{--                                    &nbsp;--}}
{{--                                    <span>@lang('lang.size')</span>--}}
{{--                                    &nbsp;--}}
{{--                                    <span class="size-menu">--}}
{{--                                        {{$s->size->name}}</span>--}}

{{--                                </button>--}}

                                <!-- Dropdown menu -->
{{--                                <div id="dropdownDotsHorizontal{{$product->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">--}}
{{--                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">--}}
{{--                                        @foreach($product->variations as $size)--}}
{{--                                            <li>--}}
{{--                                                <a data-size_id="{{$size->size_id}}" data-variation_id="{{$size->id}}"  data-size_name="{{$size->size->name}}" data-price="{{ @num_format($size->default_sell_price - $product->discount_value) }}"  class="block px-4 py-2 changeSize hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$size->size->name}}</a>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
                            </div>
                        </div>


                        @break
                        @endforeach
                    </div>


                </div>

                @endforeach
            </div>
        </div>
    </div>
    @if(count($offers_array) > 0)
        <div class="container mx-auto">
            <div class="flex">
                <div class="flex-1">
                    <div class="w-1/2 h-10 mx-auto text-center text-white bg-red mt-14 rounded-xl">
                        <h3 class="py-1 text-2xl font-semibold text-white">@lang('lang.promotions')</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto mt-14">
            <div class="w-full p-4 mx-auto">
                <div class="grid xs:grid-cols-3 md:grid-cols-4 xs:gap-2 md:gap-16 md:mt-12 xs:mt-6">
                    @foreach ($offers_array as $offer)
                        @if ($loop->index == 4)
                        @break
                    @endif
                    @include('home.partial.promotion_card', [
                        'offer' => $offer,
                    ])
                @endforeach
            </div>
        </div>

        @if (count($offers_array) != 0 && $offers_count > 4)
            <div class="container mx-auto">
                <div class="flex md:justify-end xs:justify-center">
                    <a href="{{ action('ProductController@getPromotionProducts') }}"
                        class="py-1 font-semibold text-white rounded-md bg-red md:px-4 xs:px-8 md:mr-16 md:mt-8">@lang('lang.show_more')</a>
                </div>
            </div>
        @endif
    @endif


</div>
@endsection

@section('javascript')



<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
@if (!empty($homepage_category_carousel))
    <script>
        $(document).ready(function() {
            var slider = tns({
                container: ".category-slider",
                all-items: 4,
                slideBy: "page",
                autoplay: false,
                mouseDrag: true,
                controls: false,
                nav: false,
                loop: true,
                swipeAngle: false,
            });

            document.querySelector(".next-nav").onclick = function() {
                slider.goTo("next");
            };
            document.querySelector(".prev-nav").onclick = function() {
                slider.goTo("prev");
            };
        });
    </script>
@endif


<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script>
$(document).on('click', '.plus', function() {
  const $quantityInput = $(this).siblings('.quantity');
  let quantity = parseInt($quantityInput.val());
  $quantityInput.val(quantity + 1).change();
});

$(document).on('click', '.minus', function() {
  const $quantityInput = $(this).siblings('.quantity');
  let quantity = parseInt($quantityInput.val());
  if (quantity > 1) {
    $quantityInput.val(quantity - 1).change();
  }
});

    $(document).ready(function() {
        var slider = tns({
            container: ".product-slider",
            items: 1,
            // slideBy: "page",
            autoplay: false,
            mouseDrag: true,
            controls: false,
            nav: false,
            loop: true,
            swipeAngle: false,
        });

        document.querySelector(".next-nav").onclick = function() {
            slider.goTo("next");
        };
        document.querySelector(".prev-nav").onclick = function() {
            slider.goTo("prev");
        };
    });


    $(document).on('click', '.cart_button', function(){
        var sizeId=$(this).closest('.productCard').find('input[name=size]').val();
        var variationId=$(this).closest('.productCard').find('input[name=variation]').val();
        var quantity=$(this).closest('.productCard').find('input[name=quantity]').val();
        $.ajax({
            type: "GET",
            url: '/cart/add-to-cart/' + variationId+"?quantity="+quantity,
            // data: "data",
            dataType: "json",
            success: function (response) {
                if (response.status.success) {
                    swal("", response.status.msg, "success");
                }else{
                    swal("@lang('lang.error')!", response.status.msg, "error");
                }
                $('.cart_items').load(document.URL +  ' .cart_items');
                $('.total').load(document.URL +  ' .total');
            }
        });
    })
$(document).ready(function() {
    var selected_content = document.getElementById("selected").val;
    var button_content = document.getElementById("sizes").textContent;
    if(selected_content == button_content){
        var add_selected = document.getElementById("sizes").classList.add("selected");
    }
});

    $(document).on('click', '.changeSize', function(e){
        e.preventDefault();
        var price=$(this).data('price');
        var size_id=$(this).data('size_id');
        var variation_id=$(this).data('variation_id');
        $(this).parent().parent().parent().siblings().find('.sell-price').text(price);
        var size=$(this).data('size_name');
        var s=$(this).parent().parent().parent().siblings().find('.size-menu').text(size);
        $(this).closest('.productCard').children('input[name=size]').val(size_id);
        $(this).focus()

    });
</script>
@endsection
