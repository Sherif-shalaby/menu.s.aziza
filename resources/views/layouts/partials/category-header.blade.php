<div class="w-full flex flex-row bg-no-repeat bg-center text-center items-center "
    style="background-size:100% 100%;height: 200px; background-image: url('@if(!empty(session('breadcrumb_background_image'))){{ images_asset(asset('uploads/' . session('breadcrumb_background_image'))) }}@else{{ asset('images/default-breadcrumb-bg.png') }}@endif');">
    <div class="w-full">
 

        <div class="container mx-auto mt-16">
            {{--<div class="flex justify-end w-full">
                <a class="md:text-xl xs:text-sm text-white font-semibold px-2 text-white-shadow "
                    href="{{ action('HomeController@index') }}">@lang('lang.home')</a> <span
                    class="md:text-xl xs:text-sm text-white font-semibold px-1">-</span>
                <a class="md:text-xl xs:text-sm text-white font-semibold px-2 text-white-shadow"
                    href="{{ action('ProductController@getProductListByCategory', $category->id) }}">{{ $category->name }}</a> 
            </div>--}}
        </div>
    </div>
</div>

@php
    use App\Models\ProductClass;
    $categories = ProductClass::orderBy('sort', 'asc')->where('status', 1)->where('name', '!=', 'Extras')->get();
@endphp
<div class="container-fluid mx-auto">
    <div class="flex flex-row">
        <div class="flex-3 text-white text-4xl font-bold text-left w-48">
            @include('layouts.partials.language_dropdown')
        </div>
        <div class="flex-1 ">
            <div class="width-fit h-10 bg-red text-white mx-auto text-center   rounded-xl ">
                <div class="dropdown">
                    <button class="dropbtn text-2xl text-white font-semibold py-1">{{ $category->name }}  <i class="fas fa-caret-down"></i> </button>
                    <div class="dropdown-content">
                        <a href="#"> @lang('lang.categories')</a>
                        @foreach ($categories as $category)
                            <a href="{{ action('ProductController@getProductListByCategory', $category->id) }}"> {{ $category->name }}</a>
                        @endforeach
                    </div>
                  </div>
            </div>
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
