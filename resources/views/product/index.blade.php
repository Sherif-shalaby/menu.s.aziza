@extends('layouts.new_design')
@php
$user_id = request()
->session()
->get('user_id');
$cart_count = 0;
if (!empty($user_id)) {
$cart_collection = Cart::session($user_id)->getContent();
$cart_count = $cart_collection->count();
}
@endphp

@php
$locale_direction = LaravelLocalization::getCurrentLocaleDirection();
@endphp
@section('content')

<!-- Set up carousel -->

@include('home.includes.carousel')

<!-- End carousel -->


<div class="px-3 relative">

    {{-- Start navbar --}}
    @include('home.includes.navbar')
    {{-- end navbar --}}

</div>

<div class="container mx-auto mt-14">

    <div class="w-full mx-auto p-4">
        <div class="grid xs:grid-cols-3 md:grid-cols-4 xs:gap-2 md:gap-16 md:mt-12 xs:mt-6">
            @foreach ($products as $product)
            @include('home.partial.product_card', ['product' => $product])
            @endforeach
        </div>
    </div>

    @include('layouts.partials.footer')

    {{-- @include('layouts.partials.cart-row') --}}
</div>


@include('home.includes.cart')


@endsection

@section('javascript')
<script>
    // $(document).on('click', '.product_card', function(e){
    //     if(!$(e.target).is('i.cart_icon') && !$(e.target).is('button.cart_button *')){
    //         window.location.href = $(this).data('href');
    //     }
    // })
    // $(document).on('click', '.cart_button, .cart_icon', function(){
    //     window.location.href = base_path + '/cart/add-to-cart/' + $(this).data('product_id');
    // })
    $(document).on('click', '.cart_button', function(){
        var variationId=$(this).closest('.productCard').find('input[name=variation]').val();
        $.ajax({
            type: "GET",
            url: '/cart/add-to-cart/' + variationId,
            // data: "data",
            dataType: "json",
            success: function (response) {
                if (response.status.success) {

                    Swal.fire({
                    position: 'top', // Set the position to the top
                    title: response.status.msg, // Message from your response
                    showConfirmButton: false, // No buttons
                    timer: 1000, // Auto-close after 1000ms
                    toast: true, // Display as a toast
                    background: '#28a745', // Set the background color to green (or your desired shade)
                    color: '#fff', // Set text color for better contrast
                    showClass: {
                    popup: `
                    animate__animated
                    animate__bounceInDown
                    animate__faster
                    `
                    },
                    hideClass: {
                    popup: `
                    animate__animated
                    animate__bounceOutUp
                    animate__faster
                    `
                    }
                    });
                    }else{
                        // swal.fire("@lang('lang.error')!", response.status.msg, "error");
                        Swal.fire({
                        position: 'top', // Set the position to the top
                        title: response.status.msg, // Message from your response
                        showConfirmButton: false, // No buttons
                        timer: 1000, // Auto-close after 1000ms
                        toast: true, // Display as a toast
                        background: '#dc3545', // Set the background color to green (or your desired shade)
                        color: '#fff', // Set text color for better contrast
                        showClass: {
                        popup: `
                        animate__animated
                        animate__bounceInDown
                        animate__faster
                        `
                        },
                        hideClass: {
                        popup: `
                        animate__animated
                        animate__bounceOutUp
                        animate__faster
                        `
                        }
                        });
                }
                $('.cart_items').load(document.URL +  ' .cart_items');
                $('.cart_table').load(document.URL +  ' .cart_table');

            }
        });


        // window.location.href = base_path + '/cart/add-to-cart/' + $(this).data('product_id')+'/'+sizeId;
    })
    // })
    $(document).on('click', '.changeSize', function(e){
        e.preventDefault();
        var price=$(this).data('price');
        var size_id=$(this).data('size_id');
        var variation_id=$(this).data('variation_id');
        $(this).parent().parent().parent().siblings().find('.sell-price').text(price);
        $(this).closest('.productCard').children('input[name=size]').val(size_id);
        var size=$(this).data('size_name');
        var s=$(this).parent().parent().parent().siblings().find('.size-menu').text(size);
        $(this).closest('.productCard').children('input[name=variation]').val(variation_id);
        // __write_number(size,)
        console.log($('input[name=size]').val())
        // var size_id=$(this).data('size_id');
    });
</script>

@endsection
