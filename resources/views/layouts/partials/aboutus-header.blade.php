@include('layouts.partials.navbar')


<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart  p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m ">
            <span class="mtext-103 cl2">
                <a href="{{ action('HomeController@index') }}">
                    <img src="{{ images_asset(asset('uploads/' . session('logo'))) }}" alt="IMG-LOGO">
                </a>
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <hr>
            <ul class="">
                <li class="d-flex" style="gap: 5px">
                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#2563eb' , '#1d4ed8')">
                        <span style="width: 25px;height: 25px;background-color: #2563eb" class="rounded-circle">
                        </span>
                    </button>
                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#16a34a' , '#15803d')">
                        <span style="width: 25px;height: 25px;background-color: #16a34a" class="rounded-circle">
                        </span>
                    </button>

                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#dc2626','#b91c1c')">
                        <span style="width: 25px;height: 25px;background-color: #dc2626" class="rounded-circle">
                        </span>
                    </button>

                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#0284c7','#0369a1')">
                        <span style="width: 25px;height: 25px;background-color: #0284c7" class="rounded-circle">
                        </span>
                    </button>
                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#475569','#334155')">
                        <span style="width: 25px;height: 25px;background-color: #475569" class="rounded-circle">
                        </span>
                    </button>
                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#14b8a6','#0d9488')">
                        <span style="width: 25px;height: 25px;background-color: #14b8a6" class="rounded-circle">
                        </span>
                    </button>
                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#eab308','#c8b400')">
                        <span style="width: 25px;height: 25px;background-color: #eab308" class="rounded-circle">
                        </span>
                    </button>
                    <button class="border-0 d-flex justify-content-center align-items-center"
                        onclick="changePrimaryColor('#4f46e5','#3730a3')">
                        <span style="width: 25px;height: 25px;background-color: #4f46e5" class="rounded-circle">
                        </span>
                    </button>
                </li>

                <li>
                    <!-- Add the color input -->
                    <input data-input-id="primary" id="colorPicker" type="color" type="color"
                        style="margin: 10px 0;width: 100%;" oninput="changeColorFromInput(this)"
                        title="Choose your color" />
                </li>
            </ul>
            <ul class="header-cart-wrapitem w-full">
                <br>
                <hr>
                <span class=" mtext-102-bold cl2">@lang('lang.contact_us')</span>
                <p class="text-dark   w-full cl2 ">whatsapp : {{ App\Models\System::getProperty('whatsapp') }} </p>
                <p class="text-dark  w-full cl2   ">Tel : {{ App\Models\System::getProperty('phone_number_1') }} </p>
                <hr>
                <p class="text-dark  w-full cl2  ">
                    <a class="cl2" href="https://maps.google.com/maps?q={{ App\Models\System::getProperty('address') }}"
                        target="_blank">
                        location : {{ App\Models\System::getProperty('address') }}
                </p>
                <hr>

                <span class=" mtext-102-bold cl2">@lang('lang.social_media')</span>
                <div class="pr-4   ltext-101 ">
                    <a target="_blank" href="{{ App\Models\System::getProperty('instagram') }}" class=" ltext-101">

                        <i class="fab fa-instagram w-6 h-6 mr-2 cl11"></i>
                    </a>

                    <a target="_blank" href="{{ App\Models\System::getProperty('twitter') }}" class="ltext-101">

                        <i class="fab fa-twitter w-6 h-6 mr-2 cl11  "></i>
                    </a>

                    <a target="_blank" href="{{ App\Models\System::getProperty('youtube') }}" class="ltext-101">
                        <i class="fab fa-youtube w-6 h-6 mr-2 cl11  "></i>
                    </a>

                    <a target="_blank" href="https://t.me/{{ App\Models\System::getProperty('telegram') }}"
                        class="ltext-101">

                        <i class="fab fa-telegram-plane w-6 h-6 mr-2 cl11  "></i>
                    </a>

                    <a target="_blank"
                        href="https://api.whatsapp.com/send?phone={{ App\Models\System::getProperty('whatsapp') }}"
                        class="ltext-101">

                        <i class="fab fa-whatsapp w-6 h-6 mr-2 cl11  "></i>
                    </a>

                    <a target="_blank" href="{{ App\Models\System::getProperty('facebook') }}" class="ltext-101">

                        <i class="fab fa-facebook-f w-6 h-6 mr-2 cl11  "></i>
                    </a>
                </div>
            </ul>

            <div class="w-full">
                <hr>
                <span class="mtext-102-bold cl2"> @lang('lang.language')</span>
                <div class="">
                    <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1 invisible" src="" alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            عربي
                        </p>
                    </a>

                    <a href="{{ LaravelLocalization::getLocalizedURL('nl') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/nl-flag.png') }}"
                            alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            Deutsch
                        </p>
                    </a>

                    <a href="{{ LaravelLocalization::getLocalizedURL('fr') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/fr-flag.png') }}"
                            alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            français
                        </p>
                    </a>

                    <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/en-flag.png') }}"
                            alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            English
                        </p>
                    </a>

                    <a href="{{ LaravelLocalization::getLocalizedURL('tr') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/tr-flag.png') }}"
                            alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            Turkce
                        </p>
                    </a>

                    <a href="{{ LaravelLocalization::getLocalizedURL('fa') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/fa-flag.png') }}"
                            alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            فارسی
                        </p>
                    </a>

                    <a href="{{ LaravelLocalization::getLocalizedURL('ur') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/ur-flag.png') }}"
                            alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            اردو
                        </p>
                    </a>

                    <a href="{{ LaravelLocalization::getLocalizedURL('hi') }}" class="flex items-center   -mx-2">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/hi-flag.png') }}"
                            alt="avatar">
                        <p class="text-dark text-sm mx-2">
                            हिन्दी
                        </p>
                    </a>
                </div>
                <hr>
                <br>
                <p class="p-tb-10 cl2 text-center">@lang('lang.footer_copyright')</p>
                <p class="text-dark text-center" style="font-size: small;">Tel : 00201003836917 - 00905386531059 -
                    0097433231457</p>
            </div>
        </div>
    </div>
</div>