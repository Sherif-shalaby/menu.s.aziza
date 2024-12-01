<div class="flex py-3 sticky top-0 z-40">
    <div class="flex-1">

    </div>
    <div class="flex-1 flex justify-center items-center">


        <!-- Dropdown 1 -->
        <button id="CategoriesDropdownButton" data-dropdown-toggle="CategoriesDropdownMenu"
            class="text-black bg-white hover:bg-gray-200  font-medium rounded-md text-sm px-5 py-2 text-center inline-flex items-center dark:bg-gray-600 dark:hover:dark-bg dark:focus:ring-gray-800 duration-150"
            type="button">
            @lang('lang.categories')
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <div id="CategoriesDropdownMenu" class="z-10 hidden  w-44">
            <ul class="" aria-labelledby="CategoriesDropdownButton">
                @foreach ($categories as $category)
                <li class=" dropdown_item rounded-lg"><a
                        href="{{ action('ProductController@getProductListByCategory', $category->id) }}"
                        class="mb-2 rounded-lg block px-4 py-2">{{
                        $category->name }}</a>
                </li>
                @endforeach

            </ul>
        </div>

    </div>

    <div class="flex-1 flex justify-end items-center px-3">

        <!-- Dropdown 1 -->
        <button id="langDropdownButton" data-dropdown-toggle="LangDropdownMenu"
            class="text-black bg-white hover:bg-gray-200  font-medium rounded-md text-sm px-5 py-2 text-center inline-flex items-center dark:bg-gray-600 dark:hover:dark-bg dark:focus:ring-gray-800 duration-150"
            type="button">
            @lang('lang.'.app()->getLocale())
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <div id="LangDropdownMenu" class="z-10 hidden  w-44">
            <ul class="" aria-labelledby="langDropdownButton">
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('ar') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/ar-flag.jpg') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            عربي
                        </p>
                    </a>
                </li>
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('nl') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/nl-flag.png') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            Deutsch
                        </p>
                    </a>
                </li>
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('fr') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/fr-flag.png') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            français
                        </p>
                    </a>
                </li>
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('en') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/en-flag.png') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            English
                        </p>
                    </a>
                </li>
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('tr') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/tr-flag.png') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            Turkce
                        </p>
                    </a>
                </li>
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('fa') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/fa-flag.png') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            فارسی
                        </p>
                    </a>
                </li>
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('ur') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/ur-flag.png') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            اردو
                        </p>
                    </a>
                </li>
                <li class=" dropdown_item rounded-lg"><a href="{{ LaravelLocalization::getLocalizedURL('hi') }}"
                        class="mb-2 rounded-lg  px-4 py-2 flex">
                        <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/hi-flag.png') }}"
                            alt="avatar">
                        <p class="  text-sm mb-0">
                            हिन्दी
                        </p>
                    </a>
                </li>

            </ul>
        </div>

    </div>

</div>