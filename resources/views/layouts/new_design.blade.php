<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <meta name="description" content="{{ App\Models\System::getProperty('about_us_footer') }}">
    <meta name="google-site-verification" content="qxW5PqYjtpOQSI6WJoytZMUkKkuD7iU0bo5v8wR_uHg" />

    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="translate">
    <meta name="google" content="sitelinkssearchbox">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ App\Models\System::getProperty('site_title') }}</title>
    {{--
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    --}}
    @include('layouts.partials.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .owl-carousel1,
        .card_border {

            border-bottom: 4px solid var(--primary-color)
        }

        .owl-carousel .owl-nav {
            position: absolute;

            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 64px;
            width: 100%;
            color: rgba(233, 233, 233, 0.671)
        }

        .owl-carousel1 .owl-nav {
            top: 35%;

        }

        .owl-carousel2 .owl-nav {

            top: 20%;

        }

        .owl-prev {
            position: absolute;
            left: 0;
        }

        .owl-next {
            position: absolute;
            right: 0;
        }

        .owl-theme .owl-nav [class*=owl-]:hover {
            background-color: transparent !important;
            color: white !important
        }

        .dropdown_item {
            background-color: #ffffffe8;
        }

        .dropdown_item:hover {
            background-color: #aaaaaac9;
        }

        .dark-bg {
            background-color: #333
        }

        .swal2-container {
            overflow: hidden !important;

        }

        .swal2-toast {
            background-color: #28a745 !important;
        }

        .swal2-title {
            color: #f0f0f0 !important;

        }
    </style>
    @yield('css')
</head>

<body class=" relative" style="background-color: #f0f0f0">



    @yield('content')





    <script>
        base_path = "{{ url('/') }}";
    </script>


    @include('layouts.partials.javascript')


    <script>
        console.log("{{session('order_completed')}}", 'order_completed');
            @if (!empty(session('order_completed')))
                // swal.fire("Done", "Your order has been sent successfully", "success");
                Swal.fire({
                position: 'top', // Set the position to the top
                title: "Your order has been sent successfully", // Message from your response
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
                @php
                    session()->forget('order_completed');
                @endphp
            @endif
            @if (!empty(session('status')))
                @if (session('status.success') == 1)
                    // swal.fire("", "{{ session('status.msg') }}", "success");
                    Swal.fire({
                    position: 'top', // Set the position to the top
                    title: "{{ session('status.msg') }}", // Message from your response
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
                @elseif(session('status.success') == '0')
                    // swal.fire("@lang('lang.error')!", "{{ session('status.msg') }}", "error");
                    Swal.fire({
                    position: 'top', // Set the position to the top
                    title: "{{ session('status.msg') }}", // Message from your response
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
                @endif
            @endif
    </script>
    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(jqXHR, settings) {
                    if (settings.url.indexOf('http') === -1) {
                        settings.url = base_path + settings.url;
                    }
                },
            });
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/flowbite.js')}}"></script> --}}
    <script src="{{ asset('js/datepicker.js')}}"></script>

    <script>
        $('.owl-carousel1').owlCarousel({
            dots:false,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:2500,
            autoplayHoverPause:true,
            nav:true,
            responsiveClass:true,
            smartSpeed: 1000,
            responsive:{
                0:{
                items:1,
                nav:false
                },
                600:{
                items:1,
                nav:true
                },
                1000:{
                items:1,
                nav:true,
                loop:true
                }
            }
        })

        $('.owl-carousel2').owlCarousel({
            dots:false,

            margin:10,
            loop:true,
            autoplay:true,
            autoplayTimeout:2500,
            autoplayHoverPause:true,
            nav:true,
            responsiveClass:true,
            responsive:{
                0:{
                items:6,
                nav:false
                },
                600:{
                items:6,
                nav:true
                },
                1000:{
                items:6,
                nav:true,
                loop:false
                }
            }
        })
    </script>
    {{-- <script src="{{ asset('js/flowbite.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        $(document).on('click', '#send_the_order', function(e) {
                e.preventDefault();
                $('input[type=text]').blur();
                if ($('#cart_form').valid()) {
                    $('#cart_form').submit();
                }
            });
            $(document).on('change', '.extra_checkbox', function() {
                let product_id = $(this).val();
                if ($(this).prop('checked') == true) {
                    window.location.href = base_path + "/cart/add-to-cart-extra/" + product_id;
                } else {
                    window.location.href = base_path + "/cart/remove-product/" + product_id;
                }
            })

            $(document).on('change', '.variation_radio', function() {

                if ($(this).prop('checked') == true) {
                    let product_id = $(this).data('id');
                    let variation_id = $(this).val();

                    window.location.href = base_path + "/cart/update-product-variation/" + product_id + "/" +
                        variation_id;
                }
            })
            $(document).on('change', '.quantity', function() {

                let product_id = $(this).data('id');
                let quantity = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/cart/update-product-quantity/" + product_id + "/" +quantity,
                    success: function (response) {
                        $('.order-total-price').text(response.total);


                    }
                });

            })
            $(document).on('click', '.remove_product', function() {

                let product_id = $(this).data('id');
                let row= $(this).closest('.cart_product_row')

                $.ajax({
                    type: "GET",
                    url: "/cart/remove-product/" + product_id,
                    success: function (response) {
                        row.remove();

                        Swal.fire({
                        position: 'top', // Set the position to the top
                        title: "تم ازالة المنتج بنجاح", // Message from your response
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

                        $('.cart_items').load(document.URL + ' .cart_items');
                    }
                });

            })


            $(document).on('click', '.plus', function() {
                let qty_row = $(this).closest('.qty_row')
                let quantity = __read_number($(qty_row).find('.quantity'));
                $(qty_row).find('.quantity').val(quantity + 1);
                $(qty_row).find('.quantity').change();

                Swal.fire({
                position: 'top', // Set the position to the top
                title: "تم التعديل بنجاح", // Message from your response
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
            })
            $(document).on('click', '.minus', function() {
                let qty_row = $(this).closest('.qty_row')
                let quantity = __read_number($(qty_row).find('.quantity'));
                if (quantity > 1) {
                    $(qty_row).find('.quantity').val(quantity - 1);
                    $(qty_row).find('.quantity').change();
                    Swal.fire({
                    position: 'top', // Set the position to the top
                    title: "تم التعديل بنجاح", // Message from your response
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
                }
            })

            $(document).on('change', '#order', function() {
                if ($(this).prop('checked') == true) {
                    $('.order_now').removeClass('text-dark');


                    $('.order_later').addClass('text-dark');

                    $('.order_later_div').removeClass('hidden');
                } else {
                    $('.order_now').addClass('text-dark');


                    $('.order_later').removeClass('text-dark');

                    $('.order_later_div').addClass('hidden');
                }
            })

            $(document).on('change', 'input[name="delivery_type"]', function() {
                if ($(this).val() == 'dining_in') {
                    $('.inside_restaurant_div').removeClass('hidden');
                    $('#table_no').attr('required', true);
                } else {
                    $('.inside_restaurant_div').addClass('hidden');
                    $('#table_no').attr('required', false);
                }
            })

            $(document).on('change', '#delivery', function() {
                if ($(this).prop('checked') == true) {
                    $('.i_will_pick').removeClass('text-dark');


                    $('.home_delivery').addClass('text-dark');

                } else {
                    $('.i_will_pick').addClass('text-dark');


                    $('.home_delivery').removeClass('text-dark');

                }
            })

            $(document).on('change', '#payment_type', function() {
                if ($(this).prop('checked') == true) {
                    $('.pay_online').removeClass('text-dark');


                    $('.cash_on_delivery').addClass('text-dark');

                } else {
                    $('.pay_online').addClass('text-dark');
                    $('.cash_on_delivery').removeClass('text-dark');
                }
            })


    </script>

    @yield('javascript')


</body>
