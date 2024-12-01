<button data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
    class="fixed cursor-pointer z-40 left-1/2 -translate-x-1/2 flex justify-center items-center  rounded-full w-24 h-24 bg-white "
    style="bottom: -25px" type="button">
    <div class="cart_items">
        <span class="font-bold absolute left-1/2 -translate-x-1/3 top-1/3 -translate-y-1/2 z-20">
            {{ $cart_count }}
        </span>
    </div>
    <i class="fas fa-shopping-cart absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 z-10 text-5xl"
        style="color: var(--primary-color-hover);"></i>
</button>

<div id="extralarge-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto bg-gray-400/50 h-modal md:h-full hidden">
    <div class="relative w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Cart
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="extralarge-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

            {!! Form::open(['url' => action('OrderController@store'), 'method' => 'pos', 'id' => 'cart_form']) !!}
            <div class="px-2 py-4">

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 cart_table">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:dark-bg dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Size
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Action
                                </th>
                                @if (!empty($item->associatedModel->product_details))
                                <th scope="col" class="px-6 py-3 text-center">

                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_content as $item)
                            @if ($item->attributes->extra != 1)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 cart_product_row">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{$item->attributes->size?$item->attributes->size:'' }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($item->associatedModel->variations as $variation)
                                    @if ( $variation->id==$item->attributes->variation_id)
                                    <div class="flex ">

                                        <div class="flex-1 text-base font-semibold">
                                            {{ @num_format($variation->default_sell_price -
                                            $item->attributes->discount)
                                            }}
                                            <span class="font-bold">
                                                {{ session('currency')['code'] }}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    <div class=" qty_row">
                                        <button type="button"
                                            class="minus border-2 rounded-full text-lg text-center border-dark text-dark h-8 w-8">-</button>

                                        <input type="text" data-id="{{ $item->id }}"
                                            value="{{ $item->attributes->quantity }}"
                                            class="quantity text-center text-dark w-24 line leading-none border-transparent bg-transparent focus:border-transparent focus:ring-0 count">

                                        <button type="button"
                                            class="plus border-2 rounded-full text-lg text-center border-dark text-dark h-8 w-8">+</button>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="cursor-pointer @if ($locale_direction == 'rtl')  times-right @else  times-left @endif ">
                                        <div data-id="{{$item->id }}"
                                            class="remove_product mt-2 rounded-full text-lg text-center border-lightgrey text-rose-700 h-8 w-8">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </div>
                                </td>
                                @if (!empty($item->associatedModel->product_details))

                                <td class="px-6 py-4">
                                    <p class="text-xs text-dark font-semibold">{!!
                                        $item->associatedModel->product_details !!}</p>

                                    <h3
                                        class=" @if ($item->associatedModel->variations->first()->name == 'Default') hidden @endif">
                                    </h3>
                                </td>
                                @endif
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <h3 class="font-semibold text-lg text-dark pt-5  @if ($extras->count() == 0) hidden @endif">
                    @lang('lang.extras')</h3>
                @foreach ($extras as $extra)
                <div class="flex  py-2">
                    <div class="flex-1">
                        <div class="flex ">
                            <input @if (in_array($extra->id, $cart_content->pluck('id')->toArray())) checked @endif
                            class="extra_checkbox form-check-input appearance-none h-4 w-4 border border-red
                            rounded-sm
                            bg-white
                            checked:bg-red checked:border-red focus:outline-none transition duration-200 mt-1
                            align-top
                            bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="checkbox" value="{{ $extra->id }}" id="extra">
                            <label class="form-check-label inline-block text-gray-800 font-semibold px-2" for="extra">
                                {{ $extra->name }}
                            </label>
                        </div>
                    </div>
                    <div class="flex-1 text-base font-semibold">
                        {{ @num_format($extra->sell_price - $extra->discount_value) }}<span class="font-bold">
                            {{ session('currency')['code'] }}</span>
                    </div>
                </div>
                @endforeach

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="sales_note">@lang('lang.notes')</label>
                <textarea name="sales_note" id="sales_note" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:dark-bg dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>


                <div class="flex flex-row gap-3 py-2">
                    <div class="flex-1 flex flex-col">

                        <label for="customer_name">@lang('lang.name')</label>
                        <input type="text" name="customer_name" required
                            class="border-b border-dark rounded-lg w-full px-4 " value="">
                    </div>
                    <div class="flex-1 flex flex-col">

                        <label for="address">@lang('lang.address')</label>
                        <input type="text" name="address" class="border-b border-dark rounded-lg w-full px-4 " value="">
                    </div>
                </div>


                <div class="flex py-2 justify-center">
                    <div class="flex-1">
                        <label class="order_now font-semibold text-base text-dark pr-2 pt-1 float-right"
                            for="order_now">@lang('lang.order_now')</label>
                    </div>
                    <div class="flex w-16 justify-center">
                        <div class="mt-1">
                            <label for="order" class="flex relative items-center mb-4 cursor-pointer">
                                <input type="checkbox" name="order_type" id="order" value="1" class="sr-only">
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full border border-red toggle-bg dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label class="order_later font-semibold text-base  pr-2 pt-1 float-left"
                            for="order_later">@lang('lang.order_later')</label>
                    </div>
                </div>

                <div class="flex flex-row justify-center order_later_div hidden ">
                    <img class="md:h-8 md:w-12 xs:h-4 xs:w-8 px-2 md:mt-1 xs:mt-4"
                        src="{{ asset('images/calender-icon.png') }}" alt="">
                    <select id="month" name="month"
                        class="font-w w-32 mx-2 bg-gray-50 border border-gray-300 text-gray-900 md:text-base xs:text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:p-2.5 xs:p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($month_array as $key => $month)
                        <option @if ($key==date('m')) selected @endif value="{{ $key }}">
                            {{ $month }}</option>
                        @endforeach
                    </select>
                    <select id="day" name="day"
                        class="font-w w-32 mx-2 bg-gray-50 border border-gray-300 text-gray-900 md:text-base xs:text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:p-2.5 xs:p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach (range(1, 31, 1) as $i)
                        <option @if ($i==date('d')) selected @endif value="{{ $i }}">
                            {{ $i }}</option>
                        @endforeach
                    </select>
                    <img class="md:h-8 md:w-12 xs:h-4 xs:w-8 px-2 md:mt-1 xs:mt-4"
                        src="{{ asset('images/time-icon.png') }}" alt="">

                    <input type="time" name="time" id="base-input" value="{{ date('H:i') }}"
                        class="font-w w-32 bg-gray-50 border border-gray-300 text-gray-900 md:text-base xs:text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </div>


                <div class="flex flex-row py-2  justify-center">
                    <div class="flex-1">
                        <label class="pay_online font-semibold text-base  pr-2 pt-1 float-right"
                            for="pay_online">@lang('lang.pay_online')</label>
                    </div>
                    <div class="flex w-16 justify-center">
                        <div class="mt-1">
                            <label for="payment_type" class="flex relative items-center mb-4 cursor-pointer">
                                <input type="checkbox" id="payment_type" name="payment_type" checked value="1"
                                    class="sr-only">
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full border border-red toggle-bg dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label class="cash_on_delivery font-semibold text-base text-dark pr-2 pt-1 float-left"
                            for="cash_on_delivery">@lang('lang.cash_on_delivery')</label>
                    </div>
                </div>

                <div class="flex flex-row py-2 justify-center items-center">
                    <div class="flex-1 text-center">
                        <input type="radio" name="delivery_type" value="i_will_pick_it_up_my_self" required
                            class="w-4 h-4 border-red focus:ring-2 focus:ring-red dark:focus:ring-red dark:focus:bg-red dark:bg-gray-700 dark:border-red"
                            aria-labelledby="radio" aria-describedby="radio">
                        <label class="i_will_pick font-semibold md:text-base xs:text-xs text-dark pl-2"
                            for="i_will_pick_it_up_my_self">@lang('lang.i_will_pick_it_up_my_self')</label>
                    </div>
                    <div class="flex-1 text-center">
                        <input type="radio" name="delivery_type" value="home_delivery" checked required
                            class="w-4 h-4 border-red focus:ring-2 focus:ring-red dark:focus:ring-red dark:focus:bg-red dark:bg-gray-700 dark:border-red"
                            aria-labelledby="radio" aria-describedby="radio">
                        <label class="i_will_pick font-semibold md:text-base xs:text-xs text-dark pl-2"
                            for="home_delivery">@lang('lang.home_delivery')</label>
                    </div>
                    <div class="flex-1 text-center">
                        <input type="radio" name="delivery_type" value="dining_in" required
                            class="w-4 h-4 border-red focus:ring-2 focus:ring-red dark:focus:ring-red dark:focus:bg-red dark:bg-gray-700 dark:border-red"
                            aria-labelledby="radio" aria-describedby="radio">
                        <label class="i_will_pick font-semibold md:text-base xs:text-xs text-dark pl-2"
                            for="dining_in">@lang('lang.dining_in')</label>
                    </div>
                </div>

                <div class="flex flex-row justify-center inside_restaurant_div w-1/2 mx-auto hidden ">
                    <label class="font-semibold text-base text-dark pr-2 pt-1 float-left"
                        for="table_no">@lang('lang.table_no')</label>

                    <select id="table_no" name="table_no"
                        class="w-1/4 mx-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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

            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    id="send_the_order">@lang('lang.send_the_order')
                    <span class=" text-base  order-total-price">{{ @num_format($total) }}
                        {{ session('currency')['code'] }}</span></button>
                <button data-modal-hide="extralarge-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
            </div>




            {!! Form::close() !!}
        </div>
    </div>
</div>
