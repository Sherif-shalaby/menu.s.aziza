@extends('layouts.app')
@php
$locale_direction = LaravelLocalization::getCurrentLocaleDirection();
@endphp
@section('css')

    <style>
        .c-f-s{
            color: #222;
            font-size: medium;
            font-weight: 600;
        }
        @media (max-width: 360px) {

            button#send_the_order {
                width: 100% !important;
            }

            button#send_the_order  .absolute {
                position: relative !important;
                right: 0 !important;
            }
        }
        /**/
    </style>

@endsection
@section('content')
    @include('layouts.partials.cart-header')


    <div class="container mx-auto mt-14">
        <div class="flex mt-40 bg11">

        </div>
    </div>

    <div class="container py-4 mx-auto">
        {!! Form::open(['url' => action('OrderController@store'), 'method' => 'pos', 'id' => 'cart_form']) !!}
        <div class="flex py-4 lg:flex-row xs:flex-col bg11 opacity-80 row "  >
            <div class="flow-root col-md-6 xl:px-16 lg:px-2 md:px-4 xs:px-4">
                <div class="form-group">
                    <label
                        class="font-semibold text-base cl0 mtext-101  @if ($locale_direction == 'rtl') float-right @else float-left @endif"
                        for="sales_note">@lang('lang.notes')</label>
                    <textarea class="w-full px-4 border-b rounded-lg c-f-s bg12 border-dark" name="sales_note" id="sales_note" rows="3"></textarea>
                </div>
                <div class="flex flex-row flow-root py-2">
                    <label
                        class="font-semibold text-base cl0 mtext-101 pr-2 pt-1 @if ($locale_direction == 'rtl') float-right @else float-left @endif"
                        for="customer_name">@lang('lang.name')</label>
                    <input type="text" name="customer_name" required
                        class="c-f-s bg12 border-b border-dark rounded-lg w-full px-4 w-3/5 @if ($locale_direction == 'rtl') float-left @else float-right @endif "
                        value="">
                </div>
                <div class="flex flex-row flow-root py-2">
                    <label
                        class="font-semibold text-base cl0 mtext-101 pr-2 pt-1 @if ($locale_direction == 'rtl') float-right @else float-left @endif"
                        for="phone_number">@lang('lang.phone_number')</label>
                    <input type="text" name="phone_number" required
                        class="c-f-s bg12 border-b border-dark rounded-lg w-full px-4 w-3/5 @if ($locale_direction == 'rtl') float-left @else float-right @endif "
                        value="">
                </div>
                <div class="flex flex-row flow-root py-2">
                    <label
                        class="font-semibold text-base cl0 mtext-101 pr-2 pt-1 @if ($locale_direction == 'rtl') float-right @else float-left @endif"
                        for="address">@lang('lang.address')</label>
                    <input type="text" name="address"
                        class=" c-f-s bg12 border-b border-dark rounded-lg w-full px-4 w-3/5 @if ($locale_direction == 'rtl') float-left @else float-right @endif "
                        value="">
                </div>


                <div class="flex justify-center py-2">
                    <div class="flex-1">
                        <label class="float-right pt-1 pr-2 text-base font-semibold order_now cl0 mtext-101"
                            for="order_now">@lang('lang.order_now')</label>
                    </div>
                    <div class="flex justify-center w-16">
                        <div class="mt-1">
                            <label for="order" class="relative flex items-center mb-4 cursor-pointer">
                                <input type="checkbox" name="order_type" id="order" value="1" class="sr-only">
                                <div
                                    class="h-6 bg-gray-200 border rounded-full w-11 border-red toggle-bg dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <span class="ml-3 text-sm font-medium cl5 dark:text-gray-300"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label class="float-left pt-1 pr-2 text-base font-semibold order_later text-lightgrey"
                            for="order_later">@lang('lang.order_later')</label>
                    </div>
                </div>
                <div class="flex flex-row justify-center hidden order_later_div row">
                    <div class="flex flex-row col-md-8"  style="margin-top: 10px;">
                        <img class="px-2 md:h-8 md:w-12 xs:h-4 xs:w-8 md:mt-1 xs:mt-4"
                             src="{{ asset('images/calender-icon.png') }}" alt="">
                        <select id="month" name="month"
                                class="font-select w-32 mx-2 bg12 border border-gray-300 cl5 md:text-base xs:text-xs rounded-lg focus:ring-blue-500 focus:bg12 border-blue-500 block w-full md:p-2.5 xs:p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:bg12 border-blue-500">
                            @foreach ($month_array as $key => $month)
                                <option @if ($key == date('m')) selected @endif value="{{ $key }}">
                                    {{ $month }}</option>
                            @endforeach
                        </select>
                        <select id="day" name="day"
                                class="font-select w-32 mx-2 bg12 border border-gray-300 cl5 md:text-base xs:text-xs rounded-lg focus:ring-blue-500 focus:bg12 border-blue-500 block w-full md:p-2.5 xs:p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:bg12 border-blue-500">
                            @foreach (range(1, 31, 1) as $i)
                                <option @if ($i == date('d')) selected @endif value="{{ $i }}">
                                    {{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-6" style="display: inline-flex;margin-top: 10px;">
                        <img class="px-2 md:h-8 md:w-12 xs:h-4 xs:w-8 md:mt-1 xs:mt-4"
                            src="{{ asset('images/time-icon.png') }}" alt="">
                        <input type="time" name="time" id="base-input" value="{{ date('H:i') }}"
                        class="font-select w-32 bg12 border border-gray-300 cl5 md:text-base xs:text-xs rounded-lg focus:ring-blue-500 focus:bg12 border-blue-500 block w-full py-2.5 px-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:bg12 border-blue-500">
                    </div>
                </div>
                <div class="flex flex-row justify-center py-2">
                    <div class="flex-1">
                        <label class="float-right pt-1 pr-2 text-base font-semibold pay_online text-lightgrey"
                            for="pay_online">@lang('lang.pay_online')</label>
                    </div>
                    <div class="flex justify-center w-16">
                        <div class="mt-1">
                            <label for="payment_type" class="relative flex items-center mb-4 cursor-pointer">
                                <input type="checkbox" id="payment_type" name="payment_type" checked value="1"
                                    class="sr-only">
                                <div
                                    class="h-6 bg-gray-200 border rounded-full w-11 border-red toggle-bg dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <span class="ml-3 text-sm font-medium cl5 dark:text-gray-300"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label class="float-left pt-1 pr-2 text-base font-semibold cash_on_delivery cl0 mtext-101"
                            for="cash_on_delivery">@lang('lang.cash_on_delivery')</label>
                    </div>
                </div>

                <div class="flex flex-row items-center justify-center py-2">
                    <div class="flex-1 text-center">
                        <input type="radio" name="delivery_type" value="i_will_pick_it_up_my_self" required
                            class="w-4 h-4 border-red focus:ring-2 focus:ring-red dark:focus:ring-red dark:focus:bg11 dark:bg-gray-700 dark:border-red"
                            aria-labelledby="radio" aria-describedby="radio">
                        <label class="pl-2 font-semibold i_will_pick md:text-base xs:text-xs cl0 mtext-101"
                            for="i_will_pick_it_up_my_self">@lang('lang.i_will_pick_it_up_my_self')</label>
                    </div>
                    <div class="flex-1 text-center">
                        <input type="radio" name="delivery_type" value="home_delivery" checked required
                            class="w-4 h-4 border-red focus:ring-2 focus:ring-red dark:focus:ring-red dark:focus:bg11 dark:bg-gray-700 dark:border-red"
                            aria-labelledby="radio" aria-describedby="radio">
                        <label class="pl-2 font-semibold i_will_pick md:text-base xs:text-xs cl0 mtext-101"
                            for="home_delivery">@lang('lang.home_delivery')</label>
                    </div>
                    <div class="flex-1 text-center">
                        <input type="radio" name="delivery_type" value="dining_in" required
                            class="w-4 h-4 border-red focus:ring-2 focus:ring-red dark:focus:ring-red dark:focus:bg11 dark:bg-gray-700 dark:border-red"
                            aria-labelledby="radio" aria-describedby="radio">
                        <label class="pl-2 font-semibold i_will_pick md:text-base xs:text-xs cl0 mtext-101"
                            for="dining_in">@lang('lang.dining_in')</label>
                    </div>
                </div>

                <div class="flex flex-row justify-center hidden inside_restaurant_div ">
                    <label class="float-left pt-1 pr-2 text-base font-semibold cl0 mtext-101"
                        for="table_no">@lang('lang.table_no')</label>

                    <select id="table_no" name="table_no"
                        class="w-1/4 mx-2 bg12 border border-gray-300 cl5 text-sm rounded-lg focus:ring-blue-500 focus:bg12 border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:bg12 border-blue-500">
                        <option value="">@lang('lang.please_select')</option>
                        @foreach ($dining_tables as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                @if(env('ENABLE_POS_SYNC'))
                <div class="flex flex-row justify-center mt-4">
                    <select id="store_id" name="store_id" required
                        class="w-1/2 mx-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                           @if(count($stores)==1)
                        @foreach ($stores as $id => $store)
                            <option value="{{ $id }}">{{ $store }}</option>
                        @endforeach
                        @else
                        <option selected value="">@lang('lang.enter_restaurant_store')</option>
                        @foreach ($stores as $id => $store)
                            <option value="{{ $id }}">{{ $store }}</option>
                        @endforeach
                        @endif
                    </select>

                </div>
                @endif

            </div>
            <div class="col-md-6 xl:px-16 lg:px-2 md:px-4 xs:px-4 xs:mt-8 xs:border-t-2">
                @foreach ($cart_content as $item)
                    @if ($item->attributes->extra != 1)
                    <hr>
                        <h3 class="flex-col justify-center py-3 text-white">
                            <div class="flex @if ($locale_direction == 'rtl') flex-row-reverse @else flex-row @endif ">
                            <table class="w-full m-0">
                            <tr class="flex @if ($locale_direction == 'rtl') flex-row-reverse @else flex-row @endif ">
                                <td class="w-1/1 @if ($locale_direction == 'rtl') text-right @else text-left @endif">
                                    <span class="font-semibold text-tiny ">{{ $item->name }}</span>
                                </td>

                             <td> &nbsp;  </td>

                                <td class="md:w-1/3 xs:w-6/12">
                                    <div class="flex flex-row justify-center w-full border-2 rounded-full qty_row border-dark ">
                                        <button type="button"
                                            class="w-8 h-8 text-lg text-center minus text-dark" style="padding-inline:10px;">-</button>
                                        <input type="text" data-id="{{ $item->id }}" value="{{ $item->attributes->quantity }}"
                                            class="w-8 p-0 leading-none text-center bg-transparent border-transparent quantity line focus:border-transparent focus:ring-0">
                                        <button type="button"
                                            class="h-8 text-lg text-center plus text-dark" style="padding-inline:10px;">+</button>
                                    </div>
                                </td>
                             <td> &nbsp; &nbsp;</td>

                                <td
                                    class="md:w-1/3 xs:w-6/12  @if ($locale_direction == 'rtl') text-left times-right @else text-right times-left @endif" >
                                    <a href="{{ action('CartController@removeProduct', $item->id) }}"
                                        class="w-8 h-8 p-1 text-lg text-center border-2 rounded-full border-lightgrey border-radius text-rose-700 cansel-btn">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>

                            </table>
                            </div>
                            <div class=" @if ($locale_direction == 'rtl') text-right @else text-left @endif">
                                            <p class="font-semibold text-white text-tiny ">{{$item->attributes->size?$item->attributes->size:'' }}</p>
                                </div>
                            <p class="text-xs font-semibold cl0 mtext-101">{!! $item->associatedModel->product_details !!}</p>
                            <h3
                                class="font-semibold text-base cl0 mtext-101 py-2 @if ($item->associatedModel->variations->first()->name == 'Default') hidden @endif">

                        </h3>
                            @foreach ($item->associatedModel->variations as $variation)
                                @if ( $variation->id==$item->attributes->variation_id)
                                    <div
                                        class="flex @if ($locale_direction == 'rtl') flex-row-reverse @else flex-row @endif ">

                                        {{-- <div class="flex-1">
                                            <div
                                                class="flex @if ($locale_direction == 'rtl') flex-row-reverse @else flex-row @endif items-center mb-4">
                                                <input type="radio" data-id="{{ $item->id }}"
                                                    @if ($item->attributes->variation_id == $variation->id) checked @endif
                                                    value="{{ $variation->id }}"
                                                    class="w-4 h-4 variation_radio border-red focus:ring-2 focus:ring-red dark:focus:ring-red dark:focus:bg11 dark:bg-gray-700 dark:border-red"
                                                    aria-labelledby="radio" aria-describedby="radio">
                                                <label for="radio"
                                                    class="block px-2 ml-2 text-sm font-medium cl5 dark:text-gray-300">
                                                    @if ($variation->name == 'Default')
                                                        {{ $item->name }}
                                                    @else
                                                        {{ $variation->size->name ?? '' }}
                                                    @endif
                                                </label>
                                            </div>
                                        </div> --}}
                                        <div
                                            class="flex-1 text-base @if ($locale_direction == 'rtl') text-left cl5 @else text-right @endif font-semibold">
                                            {{ @num_format($variation->default_sell_price - $item->attributes->discount) }}
                                            <span
                                                class="font-bold">
                                                {{ session('currency')['code'] }}</span>
                                        </div>
                                    </div>
                                @endif

                            @endforeach

                    @endif
                @endforeach

                <div class="flex @if ($locale_direction == 'rtl') justify-end @endif">
                    <h3
                        class="font-semibold text-lg cl0 mtext-101 pt-5 @if ($locale_direction == 'rtl') text-right @else text-right @endif @if ($extras->count() == 0) hidden @endif">
                        @lang('lang.extras')</h3>
                </div>
                @foreach ($extras as $extra)
                    <div class="flex @if ($locale_direction == 'rtl') flex-row-reverse @else flex-row @endif py-2">
                        <div class="flex-1">
                            <div class="flex @if ($locale_direction == 'rtl') flex-row-reverse @else flex-row @endif">
                                <input @if (in_array($extra->id, $cart_content->pluck('id')->toArray())) checked @endif
                                    class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border rounded-sm appearance-none cursor-pointer extra_checkbox form-check-input border-red checked:bg11 checked:border-red focus:outline-none"
                                    type="checkbox" value="{{ $extra->id }}" id="extra">
                                <label class="inline-block px-2 font-semibold text-gray-800 form-check-label" for="extra">
                                    {{ $extra->name }}
                                </label>
                            </div>
                        </div>
                        <div
                            class="flex-1 text-base @if ($locale_direction == 'rtl') text-left cl5 @else text-right @endif font-semibold">
                            {{ @num_format($extra->sell_price - $extra->discount_value) }}<span class="font-bold">
                                {{ session('currency')['code'] }}</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="flex justify-center">
            <button type="button" class="relative h-10 mt-4 text-white rounded-lg lg:w-1/4 md:w-1/2 xs:w-full bg11"
                id="send_the_order">@lang('lang.send_the_order')
                <span class="absolute text-base text-white right-2 order-total-price">{{ @num_format($total) }}
                    {{ session('currency')['code'] }}</span></button>
        </div>

        {!! Form::close() !!}
    </div>
@endsection

@section('javascript')
    <script>
        $(document).on('click', '#send_the_order', function(e) {
            e.preventDefault();
            $('input[type=text]').blur();
            if ($('#cart_form').valid()) {
                $('#cart_form').submit();
            }
        });
        $(document).on('change', '.extra_checkbox', function() {
            let product_id = $(this).val();
            if ($(this).prop('checked') == true) {
                window.location.href = base_path + "/cart/add-to-cart-extra/" + product_id;
            } else {
                window.location.href = base_path + "/cart/remove-product/" + product_id;
            }
        })

        $(document).on('change', '.variation_radio', function() {

            if ($(this).prop('checked') == true) {
                let product_id = $(this).data('id');
                let variation_id = $(this).val();

                window.location.href = base_path + "/cart/update-product-variation/" + product_id + "/" +
                    variation_id;
            }
        })
        $(document).on('change', '.quantity', function() {

            let product_id = $(this).data('id');
            let quantity = $(this).val();
            $.ajax({
                type: "GET",
                url: "/cart/update-product-quantity/" + product_id + "/" +quantity,
                success: function (response) {
                    console.log(response.total)
                    $('.order-total-price').text(response.total);
                }
            });
            // window.location.href = base_path + "/cart/update-product-quantity/" + product_id + "/" +
            //     quantity;

        })


        $(document).on('click', '.plus', function() {
            let qty_row = $(this).closest('.qty_row')
            let quantity = __read_number($(qty_row).find('.quantity'));
            $(qty_row).find('.quantity').val(quantity + 1);
            $(qty_row).find('.quantity').change();
        })
        $(document).on('click', '.minus', function() {
            let qty_row = $(this).closest('.qty_row')
            let quantity = __read_number($(qty_row).find('.quantity'));
            if (quantity > 1) {
                $(qty_row).find('.quantity').val(quantity - 1);
                $(qty_row).find('.quantity').change();
            }
        })

        $(document).on('change', '#order', function() {
            if ($(this).prop('checked') == true) {
                $('.order_now').removeClass('cl0 mtext-101');
                $('.order_now').addClass('text-lightgrey');

                $('.order_later').addClass('cl0 mtext-101');
                $('.order_later').removeClass('text-lightgrey');
                $('.order_later_div').removeClass('hidden');
            } else {
                $('.order_now').addClass('cl0 mtext-101');
                $('.order_now').removeClass('text-lightgrey');

                $('.order_later').removeClass('cl0 mtext-101');
                $('.order_later').addClass('text-lightgrey');
                $('.order_later_div').addClass('hidden');
            }
        })

        $(document).on('change', 'input[name="delivery_type"]', function() {
            if ($(this).val() == 'dining_in') {
                $('.inside_restaurant_div').removeClass('hidden');
                $('#table_no').attr('required', true);
            } else {
                $('.inside_restaurant_div').addClass('hidden');
                $('#table_no').attr('required', false);
            }
        })

        $(document).on('change', '#delivery', function() {
            if ($(this).prop('checked') == true) {
                $('.i_will_pick').removeClass('cl0 mtext-101');
                $('.i_will_pick').addClass('text-lightgrey');

                $('.home_delivery').addClass('cl0 mtext-101');
                $('.home_delivery').removeClass('text-lightgrey');
            } else {
                $('.i_will_pick').addClass('cl0 mtext-101');
                $('.i_will_pick').removeClass('text-lightgrey');

                $('.home_delivery').removeClass('cl0 mtext-101');
                $('.home_delivery').addClass('text-lightgrey');
            }
        })

        $(document).on('change', '#payment_type', function() {
            if ($(this).prop('checked') == true) {
                $('.pay_online').removeClass('cl0 mtext-101');
                $('.pay_online').addClass('text-lightgrey');

                $('.cash_on_delivery').addClass('cl0 mtext-101');
                $('.cash_on_delivery').removeClass('text-lightgrey');
            } else {
                $('.pay_online').addClass('cl0 mtext-101');
                $('.pay_online').removeClass('text-lightgrey');

                $('.cash_on_delivery').removeClass('cl0 mtext-101');
                $('.cash_on_delivery').addClass('text-lightgrey');
            }
        })
    </script>
@endsection
