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
@section('css')

@endsection


@section('content')
<!-- Set up carousel -->

@include('home.includes.carousel')

<!-- End carousel -->


<div class="px-3 relative">

    {{-- Start navbar --}}
    @include('home.includes.navbar')
    {{-- end navbar --}}



    {{-- start the most demanded --}}
    @include('home.includes.most_demanded')
    {{-- end the most demanded --}}



    {{-- start categories --}}
    @include('home.includes.categories')
    {{-- end categories --}}

    @include('layouts.partials.footer')

</div>


{{-- start Cart --}}
@include('home.includes.cart')


{{-- end Cart --}}






@endsection


@section('javascript')
{{-- carasoul --}}

<script>
    base_path = "{{ url('/') }}";
</script>

@endsection
