<div class="w-full flex flex-row bg-no-repeat bg-center text-center items-center"
    style="height: 200px; background-image: url('@if(!empty(session('_background_image'))){{ images_asset(asset('uploads/' . session('breadcrumb_background_image'))) }}@else{{ asset('images/default--bg.png') }}@endif')">
     {{--<div class="w-full">
        <div class="flex flex-row">
            <div class="flex-3 text-white text-4xl font-bold text-left">
                @include('layouts.partials.language_dropdown')
            </div>
            <div class="flex-1 mt-8 text-center">
                <p class="font-bold text-4xl text-white">@lang('lang.cart')</p>
            </div>
            <div class="flex-3 w-48 items-end">

            </div>
        </div>

        <div class="container mx-auto mt-16">
            <div class="flex justify-end w-full">
                <a class="text-xl text-white font-semibold px-2"
                    href="{{ action('HomeController@index') }}">@lang('lang.home')</a> <span
                    class="text-xl text-white font-semibold px-1">-</span>
                @if (request()->segment(2) == 'cart')
                    <a class="text-xl text-white font-semibold px-2"
                        href="{{ action('CartController@view') }}">@lang('lang.cart')</a>
                @endif

            </div>
        </div>

    </div> --}}
</div>




<div class="container-fluid mx-auto">
    <div class="flex flex-row subMenu">

        <div class="flex-3 text-white text-4xl font-bold text-left w-48">
            @include('layouts.partials.language_dropdown')
        </div>
        <div class="flex-1 ">

        </div>

        <div class="flex-3 text-white  font-bold text-right w-48">
                <div class="dropdown">
                    <a href="{{ action('HomeController@index') }}"
                    class="dropbtn bg-red text-white md:text-base xs:text-sm font-bold px-4 py-2 border-2 border-white rounded-lg">
                        @lang('lang.home') <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ action('AboutUsController@index') }}"> @lang('lang.about_us')</a>
                    </div>
                </div>
        </div>


    </div>
</div>
