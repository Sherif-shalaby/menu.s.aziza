<a href="{{ action('ProductController@getProductListByCategory', $category->id) }}"
    class="w-full h-0 shadow-lg pb-full rounded-xl bg-center bg-no-repeat bg-cover relative box-shadow-cat   mb:mb-8 xs:mb-16"
    style="background-image: url('{{ images_asset($category->getFirstMediaUrl('product_class')) }}'); margin-bottom: 15px" id="xsMarginB">
    <div class="flex absolute md:-bottom-16 xs:-bottom-10 w-full">
        <div class=" w-full lg:h-10 md:h-8 xs:h-6   bg-darkblue mx-auto text-center border-name-cat box-shadow-cat ">
            <h3 class="lg:text-xl md:text-sm xs:text-tiny text-white font-semibold py-1">{{ $category->name }}</h3>
        </div>
    </div>
</a>
