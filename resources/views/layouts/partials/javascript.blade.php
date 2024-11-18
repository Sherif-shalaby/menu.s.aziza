@php
// $moment_time_format = App\Models\System::getProperty('time_format') == '12' ? 'hh:mm A' : 'HH:mm';
$moment_time_format = 'hh:mm A';
@endphp
<script>
    var moment_time_format = "{{ $moment_time_format }}";
</script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/js.cookie.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>




<!--===============================================================================================-->
<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script>
    $(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
</script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
</script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script>
    $('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

</script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script>
    $('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
</script>

<script>
    $(document).on('change', 'input[name="delivery_type"]', function() {
            if ($(this).val() == 'dining_in') {
                $('.inside_restaurant_div').removeClass('hidden');
                $('#table_no').attr('required', true);
            } else {
                $('.inside_restaurant_div').addClass('hidden');
                $('#table_no').attr('required', false);
            }
        })
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadPrimaryColor();
        });

        function changePrimaryColor(color , hoverColor) {
        document.documentElement.style.setProperty('--primary-color', color);
        document.documentElement.style.setProperty('--primary-color-hover', hoverColor);
        localStorage.setItem('azizaMenuBg', color);
        localStorage.setItem('azizaMenuBgHover', hoverColor);

// Update the specific color input value
const colorInput = document.querySelector(`[data-input-id="${inputId}"]`);
if (colorInput) {
colorInput.value = color;
}
        }

        function loadPrimaryColor() {
        const savedColor = localStorage.getItem('azizaMenuBg');
        const savedColorHover = localStorage.getItem('azizaMenuBgHover');
        if (savedColor) {
        document.documentElement.style.setProperty('--primary-color', savedColor);
        document.documentElement.style.setProperty('--primary-color-hover', savedColorHover);
     // Update all inputs with the saved color
    const colorInputs = document.querySelectorAll('[data-input-id]');
    colorInputs.forEach(input => {
    input.value = savedColor;
    });
        }

        }


   function changeColorFromInput(input) {
    const color = input.value;
    const hoverColor = darkenColor(color, 25);
    changePrimaryColor(color, hoverColor);
    }

    function darkenColor(color, amount) {
    const num = parseInt(color.slice(1), 16);
    let r = (num >> 16) - amount;
    let g = ((num >> 8) & 0x00FF) - amount;
    let b = (num & 0x0000FF) - amount;

    r = r < 0 ? 0 : r; g=g < 0 ? 0 : g; b=b < 0 ? 0 : b; return `#${(r << 16 | g << 8 | b).toString(16).padStart(6, '0' )}`;
        }
</script>
<!--===============================================================================================-->
<script src="{{ asset('js/main.js') }}"></script>