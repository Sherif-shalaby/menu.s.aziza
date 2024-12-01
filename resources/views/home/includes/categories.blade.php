<div class="my-3 flex flex-wrap gap-6 justify-center items-center">

    @foreach ($categories as $category)
    <div class="w-56 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ action('ProductController@getProductListByCategory', $category->id) }}" class=" h-5/6">
            <img class="rounded-t-lg card_border w-full"
                src="{{images_asset($category->getFirstMediaUrl('product_class')) }}" alt="{{ $category->name }}" />
        </a>
        <div class="p-2 dark-bg rounded-b-lg">
            <a href="{{ action('ProductController@getProductListByCategory', $category->id) }}">
                <h5 class="mb-2 text-xl font-bold text-center tracking-tight text-white">{{$category->name}}</h5>
            </a>

        </div>
    </div>
    @endforeach
</div>