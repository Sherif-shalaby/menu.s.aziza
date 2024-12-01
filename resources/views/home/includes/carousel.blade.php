<div class="owl-carousel relative owl-theme owl-carousel1">

    @foreach ($categories as $category)

    <div class="item" style="height: 70vh;">
        <img class="main-cat-img" src="{{images_asset($category->getFirstMediaUrl('product_class')) }}"
            alt="{{ $category->name }}">
    </div>
    @endforeach

</div>