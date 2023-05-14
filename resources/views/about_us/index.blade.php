@extends('layouts.app')
@php
$locale_direction = LaravelLocalization::getCurrentLocaleDirection();
@endphp
@section('content')
    @include('layouts.partials.aboutus-header')
    <div class="container mx-auto mt-14 pt-4">
        <div style="height: 500px;" class="@if ($locale_direction == 'rtl') flex-row-reverse @else flex-row @endif xs:w-full lg:w-1/2  text-white pt-10">
            <div class="flex bg11 pt-5 " >
                <div class="flex-1  @if ($locale_direction == 'rtl') text-right pr-3 @else text-left pl-3 cl5 @endif" >
                    <h4 style="text-shadow: 1px 1px #bdb9b9;">
                        {!! $content !!}
                    </h4>
                    
                </div>
            </div>
        </div>

        @include('layouts.partials.cart-row')
    </div>
@endsection

@section('javascript')
@endsection
