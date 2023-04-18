<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container flex-c-m" style="justify-content: space-between;">
                <div class="flex-r-m">

                </div>

                <!-- Logo desktop -->	
                <a href="{{ action('HomeController@index') }}"  class="logo ">
                    <img src="{{ asset('uploads/' . session('logo')) }}" alt="IMG-LOGO">
                    <p class="p-lr-20 cl2 mtext-102">{{ App\Models\System::getProperty('site_title') }}</p>
                </a>

                <!-- Icon header -->
                <div class="flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11   js-show-cart"  >
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </div>
                </div>

            </nav>
        </div>	
    </div>


    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="{{ action('HomeController@index') }}" ><img src="{{ asset('uploads/' . session('logo')) }}" alt="IMG-LOGO"></a>
            <p class="p-lr-55 cl2 mtext-102">{{ App\Models\System::getProperty('site_title') }}</p>
        </div>


        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">

        <ul class="main-menu-m p-lr-5">
            <li>
                <a href="{{ action('HomeController@index') }}" >Home</a>

            </li>

            <br><hr>
            <span class=" mtext-102-bold cl0">@lang('lang.contact_us')</span>
                <p class="w-full cl0 ">whatsapp : {{ App\Models\System::getProperty('whatsapp') }} </p>
                <p class="w-full cl0   ">Tel : {{ App\Models\System::getProperty('phone_number_1') }} </p>
            <hr>
                <p class="w-full cl0  ">
                    <a class="cl0"  href="https://maps.google.com/maps?q={{ App\Models\System::getProperty('address') }}" target="_blank"> 
                        location : {{ App\Models\System::getProperty('address') }} 
                </p>
            <hr>
            <div class="pr-4   ltext-101 ">
                <a target="_blank" href="{{ App\Models\System::getProperty('instagram') }}"
                class=" ltext-101">
                
                <i class="fab fa-instagram w-6 h-6 mr-2 cl0"></i>
                </a>
        
                <a target="_blank" href="{{ App\Models\System::getProperty('twitter') }}"
                    class="ltext-101">
            
                    <i class="fab fa-twitter w-6 h-6 mr-2 cl0  "></i>
                </a>
        
                <a target="_blank" href="{{ App\Models\System::getProperty('youtube') }}"
                    class="ltext-101">
                    <i class="fab fa-youtube w-6 h-6 mr-2 cl0  "></i>
                </a>
        
                <a target="_blank" href="https://t.me/{{ App\Models\System::getProperty('telegram') }}"
                    class="ltext-101">
            
                    <i class="fab fa-telegram-plane w-6 h-6 mr-2 cl0  "></i>
                </a>
        
                <a target="_blank" href="https://api.whatsapp.com/send?phone={{ App\Models\System::getProperty('whatsapp') }}"
                    class="ltext-101">
    
                    <i class="fab fa-whatsapp w-6 h-6 mr-2 cl0  "></i>
                </a>
        
                <a target="_blank" href="{{ App\Models\System::getProperty('facebook') }}"
                    class="ltext-101">
            
                    <i class="fab fa-facebook-f w-6 h-6 mr-2 cl0  "></i>
                </a>
            </div>
        </ul>
    </div>

    <!-- Modal Search -->
  {{--  <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div> --}}
</header>