<h3 class="inline-block dark-bg text-white rounded-md px-3 py-2 mb-3">The Most Demanded</h3>
<div class="owl-carousel relative owl-theme owl-carousel2">

    @foreach ($most_demanded as $product)

    <div
        class="w-32 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 productCard">
        <a href="{{ action('ProductController@show', $product->product_id) }}">
            <img class="rounded-t-lg card_border" src="https://aziza.sherifshalaby.tech/storage/1994012/1446_image.jpeg"
                alt="" />
        </a>
        <div class="p-2 dark-bg rounded-b-lg">
            <a href="{{ action('ProductController@show', $product->product_id) }}">
                <h5 class="mb-2 text-xl font-bold text-center tracking-tight text-white">{{ $product->product_name
                    }}</h5>
            </a>
            <h5 class="text-white flex justify-between">
                {{ $product->product_price }}

                {{-- <span style="background-color: var(--primary-color)"
                    class="text-white font-bold rounded-full w-6 h-6 flex justify-center items-center cursor-pointer cart_button">+</span>
                --}}
            </h5>
        </div>
    </div>

    @endforeach

</div>
