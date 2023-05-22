@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
@section('content')

   {{-- <div class="container mx-auto">
        <div class="flex">
            <div class="flex-1">
                <div class="w-1/2 h-10 bg-red text-white mx-auto text-center -mt-5 rounded-xl">
                    <h3 class="text-2xl text-white font-semibold py-1">@lang('lang.categories')</h3>
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
    <div class="container-fluid mx-auto m-t-80 " style="background-image: url('{{ asset('images/test.jpg') }}')">
        <div class="p-tb-5 " style="overflow-x: scroll;">
            <!-- Search product -->
            <div class="flex-w flex-sb-m ">
                <div class=" filter-tope-group m-tb-10" style="display: flex;">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1  main-cat-style"  onclick="filterSelection('all')" >
                       @lang('lang.all_product') 
                    </button>
                    @foreach ($categories as $category)
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-7 m-tb-5 logo main-cat-style"  onclick="filterSelection({{$category->id}})" >
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
        <div class="w-full mx-auto p-4 ">
            <div class="grid xs:grid-cols-3 md:grid-cols-4 xs:gap-2 md:gap-16 md:mt-12 xs:mt-6" >
                @foreach ($products as $product)
                <div class="w-full mb-4 filterDiv filterDiv-{{$product->product_class_id}}">
                    <div class="w-full  shadow-lg pb-full rounded-xl bg-center bg-no-repeat bg-cover relative   product_card img-s"
                        style="box-shadow: rgba(0, 0, 0, 0.2) -7px 5px 7px;
                        background-image: url('{{images_asset($product->getFirstMediaUrl('product')) }}')">
                

                    </div>
                    <div class="productCard flex bg0 p-2 " style="flex-wrap: nowrap;justify-content: space-between;align-items: center;height:80px">
                        @foreach($product->variations as $size)
                            <input type="hidden" value="{{$size->size_id}}" name="size"/>
                            <input type="hidden" value="{{$size->id}}" name="variation"/>
                            @break
                        @endforeach
                        {{-- @if(count($product->sizes)>0) --}}
                        @foreach($product->variations as $s)
                        <div class="">
                            
                            <a href="{{ action('ProductController@show', $product->id) }}"
                                class=" w-full  cl2 text-xs text-center bg-white opacity-70 rounded-xl py-4 mt-2"
                                style="box-shadow: rgba(0, 0, 0, 0.2) -7px 5px 7px; text-align: start !important;">
                                <p class="md:text-sm xs:text-tiny font-semibold cl2 py-0 px-1">{{ Str::limit($product->name, 15) }}</p>
                                <p class="md:text-sm xs:text-tiny font-semibold cl2 py-0 px-1">
                                    {{ session('currency')['code'] }} 
                                    <span class="sell-price">
                                    {{ @num_format($s->default_sell_price - $product->discount_value) }}
                                    </span>
                                </p>
                            </a>
                            <div>
                                @if($s->size_id!==null)
                                <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal{{$product->id}}" class="bg11 text-white p-1 size-btn inline-flex items-center text-center bg-gray-900 rounded-lg hover:bg-white focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button"> 
                                    <span>
                                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>                           
                                    </span> 
                                    &nbsp;
                                    <span>@lang('lang.size')</span> 
                                    &nbsp;   
                                    <span class="size-menu">
                                        {{$s->size->name}}</span>
                                
                                </button>
                                @endif
                                <!-- Dropdown menu -->
                                <div id="dropdownDotsHorizontal{{$product->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                                        @foreach($product->variations as $size)
                                            <li>
                                                <a data-size_id="{{$size->size_id}}" data-variation_id="{{$size->id}}"  data-size_name="{{$size->size->name}}" data-price="{{ @num_format($size->default_sell_price - $product->discount_value) }}"  class="changeSize block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$size->size->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
   



                        <div class="f-me">
                            <div class="flex flex-row  mt-2">
                                <button
                                    class="minus border-2 rounded-full text-lg text-center border-dark cl0 bg11 h-8 w-8">-</button>
                                <input type="quantity" value="1" name="quantity"
                                    class="quantityp quantity text-center focus:outline-none text-dark bg-transparent w-16">
                                <button
                                    class="plus border-2 rounded-full text-lg text-center border-dark cl0 bg11 h-8 w-8">+</button>
                            </div>
                            <div class="flex">
                                
                                @foreach($product->variations as $var)
                                <a data-variation_id="{{ $var->id }}" 
                                    class="cart_button bg11 text-white font-semibold rounded-lg px-4 py-2">  
                                    <i class="fa md:text-xl xs:text-sm fa-cart-plus cart_icon"></i></a>
                                @break
                                @endforeach
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
                    <div class="w-1/2 h-10 bg-red text-white mx-auto text-center mt-14 rounded-xl">
                        <h3 class="text-2xl text-white font-semibold py-1">@lang('lang.promotions')</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto mt-14">
            <div class="w-full mx-auto p-4">
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
                        class="bg-red text-white font-semibold py-1 md:px-4 xs:px-8 rounded-md md:mr-16 md:mt-8">@lang('lang.show_more')</a>
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


        // window.location.href = base_path + '/cart/add-to-cart/' + $(this).data('product_id')+'/'+sizeId;
    })
    $(document).on('click', '.changeSize', function(e){
        e.preventDefault();
        var price=$(this).data('price');
        var size_id=$(this).data('size_id');
        var variation_id=$(this).data('variation_id');
        $(this).parent().parent().parent().parent().siblings().find('.sell-price').text(price);
        var size=$(this).data('size_name');
        var s=$(this).parent().parent().parent().siblings().find('.size-menu').text(size);
        $(this).closest('.productCard').children('input[name=size]').val(size_id);
        $(this).closest('.productCard').children('input[name=variation]').val(variation_id);
        // __write_number(size,)
        // var size_id=$(this).data('size_id');
    });
</script>
@endsection
