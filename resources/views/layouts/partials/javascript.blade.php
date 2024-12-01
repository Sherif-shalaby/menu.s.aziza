@php
// $moment_time_format = App\Models\System::getProperty('time_format') == '12' ? 'hh:mm A' : 'HH:mm';
$moment_time_format = 'hh:mm A';
@endphp
<script>
    var moment_time_format = "{{ $moment_time_format }}";
</script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
<script src="{{ asset('js/js.cookie.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@php
// Function to darken the color
function darkenColor($color, $percentage) {
$color = str_replace('#', '', $color);
$rgb = sscanf($color, "%02x%02x%02x");
for ($i = 0; $i < 3; $i++) { $rgb[$i]=round($rgb[$i] * (1 - $percentage)); $rgb[$i]=max(0, min(255, $rgb[$i])); } return
    sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]); } // Get the primary color and darken it
    $color=App\Models\System::where('key', 'color' )->first();
    $font=App\Models\System::where('key', 'font' )->first();
    $defaultColor = $color ? $color->value : 'rgb(146, 124, 64)'; // Fallback color
    $darkenDefaultColor = darkenColor($defaultColor, 0.2); // Darken by 20%
    $defaultFont = $font ? $font->value : 'Roboto'; // Fallback color
    @endphp

    <script>
        // Access the root element (CSS variables are applied here)
    const root = document.documentElement;

    // Set the primary color dynamically
    root.style.setProperty('--primary-color', "{{ $defaultColor }}");

    // Set the darkened primary color dynamically
    root.style.setProperty('--primary-color-hover', "{{ $darkenDefaultColor }}");

    root.style.setProperty('--font', "{{ $defaultFont }}");
    </script>
