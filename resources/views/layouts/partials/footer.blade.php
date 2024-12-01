<div class="footer w-full bg-footer  h-60 ">
    <div class=" mx-auto">
        <div class="flex flex-row">
            <div class="w-full text-center">
                <div class="flex-col mt-6">
                    <img src="{{ images_asset() }}" alt="logo" class="mt-8 w-24 h-24 center-img box-shadow-btn">
                    <div class="font-semibold text-dark mt-8">{{ App\Models\System::getProperty('site_title') }}</div>

                    <div>
                        <div class="pr-4 pt-2   text-lg text-dark">@lang('lang.about_us')</div>
                        <div class="pr-4 pt-2  sm:text-base xs:text-xs text-dark">
                            <a href="{{ action('AboutUsController@index') }}" class="text-primary"
                                style="color:rgb(97, 97, 219) !important;">
                                {{ App\Models\System::getProperty('about_us_footer') }}
                            </a>
                            <br><br>
                            <p class="text-dark text-center">
                                <a href="{{ action('AboutUsController@index') }}"
                                    class="bg-red text-white md:text-base xs:text-sm font-bold px-4 py-2 border-2 border-white rounded-lg">@lang('lang.show_more')
                                </a>
                            </p>
                            <br><br>
                        </div>
                    </div>


                    <div>

                        <p class="stext-107 cl7 size-201">
                            <span> <i class="fas fa-phone-alt" style="color: var(--primary-color-hover);"></i> {{
                                App\Models\System::getProperty('phone_number_1') }}
                                <i class="fa fa-whatsapp" style="color: var(--primary-color-hover);"></i> {{
                                App\Models\System::getProperty('whatsapp') }}
                            </span>
                        </p>

                        <p class="stext-107 cl7 size-201">
                            <span> <i class="fas fa-envelope" style="color: var(--primary-color-hover);"></i> {{
                                App\Models\System::getProperty('system_email') }} </span>
                        </p>

                        <p class="stext-107 cl7 size-201">
                            <span>
                                <a class="cl7"
                                    href="https://maps.google.com/maps?q={{ App\Models\System::getProperty('address') }}"
                                    target="_blank">


                                    <i class="fas fa-map-marked-alt" style="color: var(--primary-color-hover);"></i>
                                    {{ App\Models\System::getProperty('address') }}</a>
                            </span>
                        </p>
                    </div>


                    <div class="pr-4 pt-2 mt-8">
                        <a target="_blank" href="{{ App\Models\System::getProperty('instagram') }}" class="">

                            <i class="fab fa-instagram w-6 h-6 mr-2 social-font-color"></i>
                        </a>

                        <a target="_blank" href="{{ App\Models\System::getProperty('twitter') }}" class="">

                            <i class="fab fa-twitter w-6 h-6 mr-2 social-font-color"></i>
                        </a>

                        <a target="_blank" href="{{ App\Models\System::getProperty('youtube') }}" class="">
                            <i class="fab fa-youtube w-6 h-6 mr-2 social-font-color"></i>
                        </a>

                        <a target="_blank" href="https://t.me/{{ App\Models\System::getProperty('telegram') }}"
                            class="">

                            <i class="fab fa-telegram-plane w-6 h-6 mr-2 social-font-color"></i>
                        </a>

                        <a target="_blank"
                            href="https://api.whatsapp.com/send?phone={{ App\Models\System::getProperty('whatsapp') }}"
                            class="">

                            <i class="fab fa-whatsapp w-6 h-6 mr-2 social-font-color"></i>
                        </a>

                        <a target="_blank" href="{{ App\Models\System::getProperty('facebook') }}" class="">

                            <i class="fab fa-facebook-f w-6 h-6 mr-2 social-font-color"></i>
                        </a>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <div class="flex  " style="float: left;    padding-bottom: 80px;">
        <div class="flex-1 mt-10" style="font-size: small;">
            <p class="text-dark text-center ">@lang('lang.footer_copyright')</p>
            <p class="text-dark text-center  ">Tel : 00905386531059 - 00201003836917</p>

        </div>
    </div>
</div>
{{-- background-attachment: fixed; --}}
