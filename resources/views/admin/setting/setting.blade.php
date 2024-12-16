@extends('layouts.admin')

@section('title', __('lang.system_settings'))

@section('content_header')
<h1>@lang('lang.system_settings')</h1>
@stop

@section('main_content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<style>
    .preview-container {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .preview-image {
        position: relative;
        width: 150px;
        height: 150px;
    }

    .preview-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        cursor: pointer;
    }

    #cropModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 10000;
    }

    #cropModal .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 80%;
        max-height: 80%;
    }
</style>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
<style>
    .preview-logo-container {
        /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
        display: grid;
        grid-template-columns: repeat(auto-fill, 170px);
    }
    .preview-header1-container ,
    .preview-header2-container ,
    .preview-header3-container ,
    .preview-header4-container ,
    .preview-header5-container ,
    .preview-header6-container ,
    .preview-header7-container ,

    {
        /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
        display: grid;
        grid-template-columns: repeat(auto-fill, 170px);
    }

    .preview-header-container {
        /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
        display: grid;
        grid-template-columns: repeat(auto-fill, 170px);
    }

    .preview-footer-container {
        /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
        display: grid;
        grid-template-columns: repeat(auto-fill, 170px);
    }

    .preview {
        position: relative;
        width: 150px;
        height: 150px;
        padding: 4px;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        margin: 30px 0px;
        border: 1px solid #ddd;
    }

    .preview-main-background-container .preview {
        width: 300px;
        height: 100px;
        margin-bottom: 30px !important;
        margin-top: 0 !important
    }

    .preview-main-background-container .delete-btn {
        top: 100px !important;
        font-size: 25px !important
    }

    .preview-main-background-container .crop-btn {
        top: 100px !important;
        font-size: 25px !important
    }

    .preview img {
        width: 100%;
        height: 100%;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        border: 1px solid #ddd;
        object-fit: cover;

    }

    .delete-btn {
        position: absolute;
        top: 156px;
        right: 0px;
        /*border: 2px solid #ddd;*/
        border: none;
        cursor: pointer;
    }

    .delete-btn {
        background: transparent;
        color: rgba(235, 32, 38, 0.97);
    }

    .crop-btn {
        position: absolute;
        top: 156px;
        left: 0px;
        /*border: 2px solid #ddd;*/
        border: none;
        cursor: pointer;
        background: transparent;
        color: #007bff;
    }
</style>

<style>
    /* Customizing the Coloris picker */
    .clr-picker {
        width: 320px !important;
        /* Increase width */
        height: auto !important;
        /* Let the height adjust automatically */
        z-index: 9999;
    }

    .clr-swatches div {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: 1px;
        margin-bottom: 5px;
    }

    /* Adjust the swatches grid to show 10 per row */
    .clr-swatches {
        grid-template-columns: repeat(10, 1fr) !important;
        /* 10 swatches per row */
    }
</style>
@php
$logo=App\Models\System::where('key','logo')->get();
$header1=App\Models\System::where('key','header1')->get();
$header2=App\Models\System::where('key','header2')->get();
$header3=App\Models\System::where('key','header3')->get();
$header4=App\Models\System::where('key','header4')->get();
$header5=App\Models\System::where('key','header5')->get();
$header6=App\Models\System::where('key','header6')->get();
$header7=App\Models\System::where('key','header7')->get();


$home_background_image=App\Models\System::where('key','home_background_image')->get();
$breadcrumb_background_image=App\Models\System::where('key','breadcrumb_background_image')->get();
$page_background_image=App\Models\System::where('key','page_background_image')->get();

$color=App\Models\System::where('key','color')->first();
$font=App\Models\System::where('key','font')->first();

$defaultColor = $color->value ?? "rgb(146, 124, 64)";

$defaultFont = $font->value ?? "Roboto";
@endphp


{!! Form::open(['url' => action('Admin\SettingController@saveSystemSettings'), 'method' => 'post', 'id' =>
'setting_form', 'class' => 'dropzone','files' => true,'enctype'=>"multipart/form-data"]) !!}
<x-adminlte-card title="{{ __('lang.system_settings') }}" theme="{{ config('adminlte.right_sidebar_theme') }}"
    theme-mode="outline" icon="fas fa-file">
    <div class="row">
        {{-- logo --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('logo', __('lang.logo'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-logo">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-logo-container">
                    @if (!empty($logo) && isset($settings['logo']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['logo']) }}" id="img_logo_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="logo"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-logo-btn" data-toggle="modal"
                            data-target="#logoModal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_logo_images"></div>

        <div class="modal fade" id="logoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-logo-modal" style="display:none">
                            <div id="croppie-logo-container"></div>
                            <button data-dismiss="modal" id="croppie-logo-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-logo-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end logo --}}


        {{-- header1 --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('header1', __('lang.header1'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-header1">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-header1-container">
                    @if (!empty($header1) && isset($settings['header1']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['header1']) }}" id="img_header1_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="header1"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-header1-btn" data-toggle="modal"
                            data-target="#header1Modal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_header1_images"></div>

        <div class="modal fade" id="header1Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-header1-modal" style="display:none">
                            <div id="croppie-header1-container"></div>
                            <button data-dismiss="modal" id="croppie-header1-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-header1-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end header1 --}}

        {{-- header2 --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('header2', __('lang.header2'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-header2">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-header2-container">
                    @if (!empty($header2) && isset($settings['header2']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['header2']) }}" id="img_header2_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="header2"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-header2-btn" data-toggle="modal"
                            data-target="#header2Modal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_header2_images"></div>

        <div class="modal fade" id="header2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-header2-modal" style="display:none">
                            <div id="croppie-header2-container"></div>
                            <button data-dismiss="modal" id="croppie-header2-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-header2-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end header2 --}}

        {{-- header3 --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('header3', __('lang.header3'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-header3">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-header3-container">
                    @if (!empty($header3) && isset($settings['header3']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['header3']) }}" id="img_header3_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="header3"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-header3-btn" data-toggle="modal"
                            data-target="#header3Modal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_header3_images"></div>

        <div class="modal fade" id="header3Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-header3-modal" style="display:none">
                            <div id="croppie-header3-container"></div>
                            <button data-dismiss="modal" id="croppie-header3-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-header3-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end header3 --}}

        {{-- header4 --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('header4', __('lang.header4'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-header4">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-header4-container">
                    @if (!empty($header4) && isset($settings['header4']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['header4']) }}" id="img_header4_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="header4"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-header4-btn" data-toggle="modal"
                            data-target="#header4Modal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_header4_images"></div>

        <div class="modal fade" id="header4Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-header4-modal" style="display:none">
                            <div id="croppie-header4-container"></div>
                            <button data-dismiss="modal" id="croppie-header4-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-header4-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end header4 --}}

        {{-- header5 --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('header5', __('lang.header5'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-header5">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-header5-container">
                    @if (!empty($header5) && isset($settings['header5']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['header5']) }}" id="img_header5_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="header5"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-header5-btn" data-toggle="modal"
                            data-target="#header5Modal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_header5_images"></div>

        <div class="modal fade" id="header5Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-header5-modal" style="display:none">
                            <div id="croppie-header5-container"></div>
                            <button data-dismiss="modal" id="croppie-header5-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-header5-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end header5 --}}

        {{-- header6 --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('header6', __('lang.header6'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-header6">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-header6-container">
                    @if (!empty($header6) && isset($settings['header6']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['header6']) }}" id="img_header6_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="header6"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-header6-btn" data-toggle="modal"
                            data-target="#header6Modal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_header6_images"></div>

        <div class="modal fade" id="header6Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-header6-modal" style="display:none">
                            <div id="croppie-header6-container"></div>
                            <button data-dismiss="modal" id="croppie-header6-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-header6-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end header6 --}}

        {{-- header7 --}}
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('header7', __('lang.header7'), []) !!} <small class="text-red">@lang('lang.250_250')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-header7">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-header7-container">
                    @if (!empty($header7) && isset($settings['header7']))
                    <div class="preview">
                        <img src="{{ asset('uploads/'. $settings['header7']) }}" id="img_header7_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image" data-type="header7"><i
                                style="font-size: 25px;" class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-header7-btn" data-toggle="modal"
                            data-target="#header7Modal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_header7_images"></div>

        <div class="modal fade" id="header7Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-header7-modal" style="display:none">
                            <div id="croppie-header7-container"></div>
                            <button data-dismiss="modal" id="croppie-header7-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-header7-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end header7 --}}











        <div class="col-md-4">
            <div class="form-group">
                @if (!empty($home_background_image) && isset($settings['home_background_image']))
                <button type="button" class="btn btn-xs btn-danger remove_image" data-type="home_background_image"><i
                        class="fa fa-times"></i></button>
                @endif
                {!! Form::label('home_background_image', __('lang.home_background_image'), []) !!} <small
                    class="text-red">@lang('lang.1350_450')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-home">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-home-container">
                    @if ( isset($settings['home_background_image']))
                    <div class="preview">
                        <img src="{{ asset(" uploads/". $settings['home_background_image']) }}" id="img_home_footer"
                            alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image"
                            data-type="home_background_image"><i style="font-size: 25px;"
                                class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-home-btn" data-toggle="modal"
                            data-target="#homeModal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>

                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_home_images"></div>
        <div class="modal fade" id="homeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-home-modal" style="display:none">
                            <div id="croppie-home-container"></div>
                            <button data-dismiss="modal" id="croppie-home-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-home-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end home --}}
        <div class="col-md-4">
            <div class="form-group">
                @if (!empty($breadcrumb_background_image) && isset($settings['breadcrumb_background_image']))
                <button type="button" class="btn btn-xs btn-danger remove_image"
                    data-type="breadcrumb_background_image"><i class="fa fa-times"></i></button>
                @endif
                {!! Form::label('breadcrumb_background_image', __('lang.breadcrumb_background_image'), []) !!} <small
                    class="text-red">@lang('lang.1350_450')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}"
                    id="file-input-breadcrumb">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot> //Breadcrumb_background_image
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-breadcrumb-container">
                    @if ( isset($settings['breadcrumb_background_image']))
                    <div class="preview">
                        <img src="{{ asset(" uploads/". $settings['breadcrumb_background_image']) }}"
                            id="img_breadcrumb_footer" alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image"
                            data-type="breadcrumb_background_image"><i style="font-size: 25px;"
                                class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-breadcrumb-btn" data-toggle="modal"
                            data-target="#breadcrumbModal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>

                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_breadcrumb_images"></div>
        <div class="modal fade" id="breadcrumbModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-breadcrumb-modal" style="display:none">
                            <div id="croppie-breadcrumb-container"></div>
                            <button data-dismiss="modal" id="croppie-breadcrumb-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-breadcrumb-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end breadcrumb --}}
        <div class="col-md-4">
            <div class="form-group">
                @if (!empty($page_background_image) && isset($settings['page_background_image']))
                <button type="button" class="btn btn-xs btn-danger remove_image" data-type="page_background_image"><i
                        class="fa fa-times"></i></button>
                @endif
                {!! Form::label('page_background_image', __('lang.page_background_image'), []) !!} <small
                    class="text-red">@lang('lang.1350_450')</small>
                <x-adminlte-input-file name="file" placeholder="{{ __('lang.choose_a_file') }}" id="file-input-page">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="col-10 offset-1">
                <div class="preview-page-container">
                    @if ( isset($settings['page_background_image']))
                    <div class="preview">
                        <img src="{{ asset(" uploads/". $settings['page_background_image']) }}" id="img_page_footer"
                            alt="">
                        <button class="btn btn-xs btn-danger delete-btn remove_image"
                            data-type="page_background_image"><i style="font-size: 25px;"
                                class="fa fa-trash"></i></button>
                        <span class="btn btn-xs btn-primary  crop-btn" id="crop-page-btn" data-toggle="modal"
                            data-target="#pageModal"><i style="font-size: 25px;" class="fas fa-crop"></i></span>

                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div id="cropped_page_images"></div>
        <div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('lang.page_background_image')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-page-modal" style="display:none">
                            <div id="croppie-page-container"></div>
                            <button data-dismiss="modal" id="croppie-page-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-page-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('site_title', __('lang.site_title'), []) !!}
                {!! Form::text('site_title', !empty($settings['site_title']) ? $settings['site_title'] : null, ['class'
                => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('facebook', __('lang.facebook'), []) !!}
                {!! Form::text('facebook', !empty($settings['facebook']) ? $settings['facebook'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('twitter', __('lang.twitter'), []) !!}
                {!! Form::text('twitter', !empty($settings['twitter']) ? $settings['twitter'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('whatsapp', __('lang.whatsapp'), []) !!} <small>i.e 90123456789</small>
                {!! Form::text('whatsapp', !empty($settings['whatsapp']) ? $settings['whatsapp'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('youtube', __('lang.youtube'), []) !!}
                {!! Form::text('youtube', !empty($settings['youtube']) ? $settings['youtube'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('instagram', __('lang.instagram'), []) !!}
                {!! Form::text('instagram', !empty($settings['instagram']) ? $settings['instagram'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('telegram', __('lang.telegram'), []) !!}
                {!! Form::text('telegram', !empty($settings['telegram']) ? $settings['telegram'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('phone_number_1', __('lang.phone_number_1'), []) !!}
                {!! Form::text('phone_number_1', !empty($settings['phone_number_1']) ? $settings['phone_number_1'] :
                null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('phone_number_2', __('lang.phone_number_2'), []) !!}
                {!! Form::text('phone_number_2', !empty($settings['phone_number_2']) ? $settings['phone_number_2'] :
                null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('system_email', __('lang.email'), []) !!}
                {!! Form::text('system_email', !empty($settings['system_email']) ? $settings['system_email'] : null,
                ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('open_time', __('lang.open_time'), []) !!}
                {!! Form::text('open_time', !empty($settings['open_time']) ? $settings['open_time'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('address', __('lang.address'), []) !!}
                {!! Form::text('address', !empty($settings['address']) ? $settings['address'] : null, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            {!! Form::label('language', __('lang.language'), []) !!}
            {!! Form::select('language', $locales, !empty($settings['language']) ? $settings['language'] : null,
            ['class' => 'form-control select2', 'data-live-search' => 'true', 'placeholder' =>
            __('lang.please_select')]) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('currency', __('lang.currency'), []) !!}
            {!! Form::select('currency', $currencies, !empty($settings['currency']) ? $settings['currency'] : null,
            ['class' => 'form-control select2', 'data-live-search' => 'true']) !!}
        </div>
        <br>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('about_us_footer', __('lang.about_us_footer'), []) !!}
                {!! Form::text('about_us_footer', !empty($settings['about_us_footer']) ? $settings['about_us_footer'] :
                null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('about_us_content', __('lang.about_us_content'), []) !!} <p>@lang('lang.tags'):
                    {store_name}, {store_location}, {store_phone_number},
                    {all_store_names} <i class="fa fa-info-circle text-primary" data-toggle="tooltip"
                        title="@lang('lang.use_tags_info')"></i></p>
                @php
                $config = config('adminlte.editor');
                @endphp
                <x-adminlte-text-editor name="about_us_content" :config="$config">
                    {{ !empty($settings['about_us_content']) ? $settings['about_us_content'] : null }}
                </x-adminlte-text-editor>
            </div>
        </div>

        <div class="col-md-4 hide">
            <div class="form-group">
                {!! Form::label('homepage_category_count', __('lang.homepage_category_count'), []) !!}
                {!! Form::select('homepage_category_count', [4 => 4, 8 => 8],
                !empty($settings['homepage_category_count']) ? $settings['homepage_category_count'] : 8, ['class' =>
                'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('homepage_category_carousel', __('lang.homepage_category_carousel'), []) !!} <br>
                {!! Form::checkbox('homepage_category_carousel', 1, !empty($settings['homepage_category_carousel']) ?
                true : false, ['class']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 ">

            {!! Form::label('color', __('lang.color'), ["class" => "d-block"]) !!}
            <input type="text" name="color" value="{{ $defaultColor }}" data-coloris>
        </div>

        <div class="col-md-6">
            {!! Form::label('font', __('lang.font'), []) !!}
            {!! Form::select('font', [],$defaultFont ?? '', ['class' =>
            'form-control',
            'id' => "font"]) !!}
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
        </div>
    </div>
</x-adminlte-card>

{!! Form::close() !!}
<!-- Crop Modal -->
<div id="cropModal">
    <div class="modal-content">
        <img id="imageToCrop">
        <div>
            <button id="applyCrop" type="button" class="btn btn-success">Apply Crop</button>
            <button id="cancelCrop" type="button" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</div>

@stop
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>
<script>
    const fonts = [
    "Roboto",
    "Cairo",
    "Open Sans",
    "Markazi Text",
    "Lato",
    "Tajawal",
    "Montserrat",
    "Lateef",
    "Poppins",
    "Lora",
    "Raleway",
    "Baloo Bhaijaan 2",
    "Merriweather",
    "Harmattan",
    "Ubuntu",
    "Reem Kufi",
    "Slabo 27px",
    "El Messiri",
    "Roboto Slab",
    "Aref Ruqaa",
    "Oswald",
    "Source Sans Pro",
    "Nunito",
    "Amiri",
    "Changa",
    "PT Sans",
    "Playfair Display",
    "Jomhuria",
    "Scheherazade",
    "Quicksand",
    "Fira Sans",
    "Mirza",
    "Noto Kufi Arabic",
    "Noto Naskh Arabic",
    "Josefin Sans",
    "Lalezar",
    "IBM Plex Sans Arabic",
    "Droid Arabic Kufi",
    "Droid Arabic Naskh",
    "Almarai",
    "Changa One",
    "Tinos",
    "Aladin",
    "Mada",
    "Khand",
    "Rakkas",
    "Scheherazade New",
    "Alfa Slab One",
    "Damion",
    "Shadows Into Light",
    "Jomhuria Extended",
    "Reem Kufi Ink",
    "Baloo Tammudu 2",
    "Pattaya",
    "Coda",
    "Anton",
    "Vibes Rounded",
    "Exo",
    ];

    const fontSelect = document.getElementById('font');
    const defaultFont = "{{ $defaultFont ?? 'Roboto' }}"; // Default font from the backend

    fonts.forEach(font => {
    const option = document.createElement('option');
    option.value = font;
    option.textContent = `${font} - ABC     أبجد هوز`;
    option.style.setProperty("font-family", font, "important");

    // Check if this font is the default and set it as selected
    if (font === defaultFont) {
    option.selected = true;
    }

    fontSelect.appendChild(option);
    fontSelect.style.setProperty("font-family", font, "important");
    });
</script>
<script>
    Coloris({

        theme: 'large',
        swatches: [
            // Slate
            "#f8fafc", "#f1f5f9", "#e2e8f0", "#cbd5e1", "#94a3b8", "#64748b", "#475569", "#334155", "#1e293b", "#0f172a",
            // Gray
            "#f9fafb", "#f3f4f6", "#e5e7eb", "#d1d5db", "#9ca3af", "#6b7280", "#4b5563", "#374151", "#1f2937", "#111827",

            // Stone
            "#fafaf9", "#f5f5f4", "#e7e5e4", "#d6d3d1", "#a8a29e", "#78716c", "#57534e", "#44403c", "#292524", "#1c1917",
            // Red
            "#fef2f2", "#fee2e2", "#fecaca", "#fca5a5", "#f87171", "#ef4444", "#dc2626", "#b91c1c", "#991b1b", "#7f1d1d",
            // Orange
            "#fff7ed", "#ffedd5", "#fed7aa", "#fdba74", "#fb923c", "#f97316", "#ea580c", "#c2410c", "#9a3412", "#7c2d12",
            // Amber
            "#fffbeb", "#fef3c7", "#fde68a", "#fcd34d", "#fbbf24", "#f59e0b", "#d97706", "#b45309", "#92400e", "#78350f",
            // Yellow
            "#fefce8", "#fef9c3", "#fef08a", "#fde047", "#facc15", "#eab308", "#ca8a04", "#a16207", "#854d0e", "#713f12",
            // Lime
            "#f7fee7", "#ecfccb", "#d9f99d", "#bef264", "#a3e635", "#84cc16", "#65a30d", "#4d7c0f", "#3f6212", "#365314",
            // Green
            "#f0fdf4", "#dcfce7", "#bbf7d0", "#86efac", "#4ade80", "#22c55e", "#16a34a", "#15803d", "#166534", "#14532d",
            // Emerald
            "#ecfdf5", "#d1fae5", "#a7f3d0", "#6ee7b7", "#34d399", "#10b981", "#059669", "#047857", "#065f46", "#064e3b",
            // Teal
            "#f0fdfa", "#ccfbf1", "#99f6e4", "#5eead4", "#2dd4bf", "#14b8a6", "#0d9488", "#0f766e", "#115e59", "#134e4a",
            // Cyan
            "#ecfeff", "#cffafe", "#a5f3fc", "#67e8f9", "#22d3ee", "#06b6d4", "#0891b2", "#0e7490", "#155e75", "#164e63",
            // Sky
            "#f0f9ff", "#e0f2fe", "#bae6fd", "#7dd3fc", "#38bdf8", "#0ea5e9", "#0284c7", "#0369a1", "#075985", "#0c4a6e",
            // Blue
            "#eff6ff", "#dbeafe", "#bfdbfe", "#93c5fd", "#60a5fa", "#3b82f6", "#2563eb", "#1d4ed8", "#1e40af", "#1e3a8a",
            // Indigo
            "#eef2ff", "#e0e7ff", "#c7d2fe", "#a5b4fc", "#818cf8", "#6366f1", "#4f46e5", "#4338ca", "#3730a3", "#312e81",
            // Violet
            "#f5f3ff", "#ede9fe", "#ddd6fe", "#c4b5fd", "#a78bfa", "#8b5cf6", "#7c3aed", "#6d28d9", "#5b21b6", "#4c1d95",
            // Purple
            "#faf5ff", "#f3e8ff", "#e9d5ff", "#d8b4fe", "#c084fc", "#a855f7", "#9333ea", "#7e22ce", "#6b21a8", "#581c87",
            // Fuchsia
            "#fdf4ff", "#fae8ff", "#f5d0fe", "#f0abfc", "#e879f9", "#d946ef", "#c026d3", "#a21caf", "#86198f", "#701a75",
            // Pink
            "#fdf2f8", "#fce7f3", "#fbcfe8", "#f9a8d4", "#f472b6", "#ec4899", "#db2777", "#be185d", "#9d174d", "#831843",
            // Rose
            "#fff1f2", "#ffe4e6", "#fecdd3", "#fda4af", "#fb7185", "#f43f5e", "#e11d48", "#be123c", "#9f1239", "#881337"
            ],
    });
</script>
<script>
    $("[name='homepage_category_carousel']").bootstrapSwitch();

        $(document).on('click', '.remove_image', function() {
            var type = $(this).data('type');
            $.ajax({
                url: "/admin/settings/remove-image/" + type,
                type: "POST",
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
</script>
<script>
    //Page_background_image
    var filePageInput = document.querySelector('#file-input-page');
    var previewPageContainer = document.querySelector('.preview-page-container');
    var croppiePageModal = document.querySelector('#croppie-page-modal');
    var croppiePageContainer = document.querySelector('#croppie-page-container');
    var croppiePageCancelBtn = document.querySelector('#croppie-page-cancel-btn');
    var croppiePageSubmitBtn = document.querySelector('#croppie-page-submit-btn');
    // let currentFiles = [];
    filePageInput.addEventListener('change', () => {
        previewPageContainer.innerHTML = '';
        let files = Array.from(filePageInput.files)
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            let fileType = file.type.slice(file.type.indexOf('/') + 1);
            let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
            // if (file.type.match('image.*')) {
            if (FileAccept.includes(fileType)) {
                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    const preview = document.createElement('div');
                    preview.classList.add('preview');
                    const img = document.createElement('img');
                    const actions = document.createElement('div');
                    actions.classList.add('action_div');
                    img.src = reader.result;
                    preview.appendChild(img);
                    preview.appendChild(actions);
                    const container = document.createElement('div');
                    const deleteBtn = document.createElement('span');
                    deleteBtn.classList.add('delete-btn');
                    deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                    deleteBtn.addEventListener('click', () => {
                        Swal.fire({
                            title: '{{ __("site.Are you sure?") }}',
                            text: "{{ __("site.You won't be able to delete!") }}",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Deleted!',
                                    '{{ __("site.Your Image has been deleted.") }}',
                                    'success'
                                )
                                files.splice(file, 1)
                                preview.remove();
                                getPageImages()
                            }
                        });
                    });
                    preview.appendChild(deleteBtn);
                    const cropBtn = document.createElement('span');
                    cropBtn.setAttribute("data-toggle", "modal")
                    cropBtn.setAttribute("data-target", "#pageModal")
                    cropBtn.classList.add('crop-btn');
                    cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                    cropBtn.addEventListener('click', () => {
                        setTimeout(() => {
                            launchPageCropTool(img);
                        }, 500);
                    });
                    preview.appendChild(cropBtn);
                    previewPageContainer.appendChild(preview);
                });
                reader.readAsDataURL(file);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("site.Oops...") }}',
                    text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                })
            }
        }

        getPageImages()
    });
    function launchPageCropTool(img) {
        // Set up Croppie options
        var croppieOptions = {
            viewport: {
                width: 450,
                height: 350,
                type: 'square' // or 'square'
            },
            boundary: {
                width: 600,
                height: 550,
            },
            enableOrientation: true
        };

        // Create a new Croppie instance with the selected image and options
        var croppie = new Croppie(croppiePageContainer, croppieOptions);
        croppie.bind({
            url: img.src,
            orientation: 1,
        });

        // Show the Croppie modal
        croppiePageModal.style.display = 'block';

        // When the user clicks the "Cancel" button, hide the modal
        croppiePageCancelBtn.addEventListener('click', () => {
            croppiePageModal.style.display = 'none';
            $('#pageModal').modal('hide');
            croppie.destroy();
        });

        // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
        croppiePageSubmitBtn.addEventListener('click', () => {
            croppie.result({
                type: 'canvas',
                size: {
                    width: 1350,
                    height: 900
                },
                quality: 1 // Set quality to 1 for maximum quality
            }).then((croppedImg) => {
                img.src = croppedImg;
                croppiePageModal.style.display = 'none';
                $('#pageModal').modal('hide');
                croppie.destroy();
                getPageImages()
            });
        });
    }
            // edit Case
            @if(!empty($page_background_image) &&  isset($settings['page_background_image']))
                document.getElementById("crop-page-btn").addEventListener('click', () => {

                    console.log(("#exampleModal"))
                    setTimeout(() => {
                        launchPageCropTool(document.getElementById("img_page_footer"));
                    }, 500);
                });
                document.getElementById("deleteBtn").addEventListener('click', () => {
                    if (window.confirm('Are you sure you want to delete this image?')) {
                        $("#preview").remove();
                    }
                });
        @endif
    function getPageImages() {
        setTimeout(() => {
            const container = document.querySelectorAll('.preview-page-container');
            let images = [];
            $("#cropped_page_images").empty();
            for (let i = 0; i < container[0].children.length; i++) {
                images.push(container[0].children[i].children[0].src)
                var newInput = $("<input>").attr("type", "hidden").attr("name", "page").val(container[0].children[i].children[0].src);
                $("#cropped_page_images").append(newInput);
            }
            return images
        }, 300);
    }

</script>
<script>
    //Breadcrumb_background_image
        var fileBreadcrumbInput = document.querySelector('#file-input-breadcrumb');
        var previewBreadcrumbContainer = document.querySelector('.preview-breadcrumb-container');
        var croppieBreadcrumbModal = document.querySelector('#croppie-breadcrumb-modal');
        var croppieBreadcrumbContainer = document.querySelector('#croppie-breadcrumb-container');
        var croppieBreadcrumbCancelBtn = document.querySelector('#croppie-breadcrumb-cancel-btn');
        var croppieBreadcrumbSubmitBtn = document.querySelector('#croppie-breadcrumb-submit-btn');
        // let currentFiles = [];
        fileBreadcrumbInput.addEventListener('change', () => {
            previewBreadcrumbContainer.innerHTML = '';
            let files = Array.from(fileBreadcrumbInput.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getBreadcrumbImages()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#breadcrumbModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchBreadcrumbCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewBreadcrumbContainer.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getBreadcrumbImages()
        });
        function launchBreadcrumbCropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
                viewport: {
                    width: 600,
                    height: 200,
                    type: 'square' // or 'square'
                },
                boundary: {
                    width: 600,
                    height: 550,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieBreadcrumbContainer, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieBreadcrumbModal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieBreadcrumbCancelBtn.addEventListener('click', () => {
                croppieBreadcrumbModal.style.display = 'none';
                $('#breadcrumbModal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieBreadcrumbSubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                        width: 1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieBreadcrumbModal.style.display = 'none';
                    $('#breadcrumbModal').modal('hide');
                    croppie.destroy();
                    getBreadcrumbImages()
                });
            });
        }
                // edit Case
                @if(!empty($breadcrumb_background_image) &&  isset($settings['breadcrumb_background_image']))
                    document.getElementById("crop-breadcrumb-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchBreadcrumbCropTool(document.getElementById("img_breadcrumb_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getBreadcrumbImages() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-breadcrumb-container');
                let images = [];
                $("#cropped_breadcrumb_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "breadcrumb").val(container[0].children[i].children[0].src);
                    $("#cropped_breadcrumb_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>
<script>
    //home_background_image
        var fileHomeInput = document.querySelector('#file-input-home');
        var previewHomeContainer = document.querySelector('.preview-home-container');
        var croppieHomeModal = document.querySelector('#croppie-home-modal');
        var croppieHomeContainer = document.querySelector('#croppie-home-container');
        var croppieHomeCancelBtn = document.querySelector('#croppie-home-cancel-btn');
        var croppieHomeSubmitBtn = document.querySelector('#croppie-home-submit-btn');
        // let currentFiles = [];
        fileHomeInput.addEventListener('change', () => {
            previewHomeContainer.innerHTML = '';
            let files = Array.from(fileHomeInput.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHomeImages()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#homeModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHomeCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHomeContainer.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHomeImages()
        });
        function launchHomeCropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
                viewport: {
                    width: 450,
                    height: 250,
                    type: 'square' // or 'square'
                },
                boundary: {
                    width: 600,
                    height: 550,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHomeContainer, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHomeModal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHomeCancelBtn.addEventListener('click', () => {
                croppieHomeModal.style.display = 'none';
                $('#homeModal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHomeSubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                        width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHomeModal.style.display = 'none';
                    $('#homeModal').modal('hide');
                    croppie.destroy();
                    getHomeImages()
                });
            });
        }
                // edit Case
                @if(!empty($home_background_image) &&  isset($settings['home_background_image']))
                    document.getElementById("crop-home-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHomeCropTool(document.getElementById("img_home_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHomeImages() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-home-container');
                let images = [];
                $("#cropped_home_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "home").val(container[0].children[i].children[0].src);
                    $("#cropped_home_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>
<script>
    //logo
        var fileLogoInput = document.querySelector('#file-input-logo');
        var previewLogoContainer = document.querySelector('.preview-logo-container');
        var croppieLogoModal = document.querySelector('#croppie-logo-modal');
        var croppieLogoContainer = document.querySelector('#croppie-logo-container');
        var croppieLogoCancelBtn = document.querySelector('#croppie-logo-cancel-btn');
        var croppieLogoSubmitBtn = document.querySelector('#croppie-logo-submit-btn');
        // let currentFiles = [];
        fileLogoInput.addEventListener('change', () => {
            previewLogoContainer.innerHTML = '';
            let files = Array.from(fileLogoInput.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getLogoImages()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#logoModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchLogoCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewLogoContainer.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getLogoImages()
        });
        function launchLogoCropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square' // or 'square'
                },
                boundary: {
                    width: 300,
                    height: 300,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieLogoContainer, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieLogoModal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieLogoCancelBtn.addEventListener('click', () => {
                croppieLogoModal.style.display = 'none';
                $('#logoModal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieLogoSubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                        width: 250,
                        height: 250
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieLogoModal.style.display = 'none';
                    $('#logoModal').modal('hide');
                    croppie.destroy();
                    getLogoImages()
                });
            });
        }
                // edit Case
                @if (!empty($logo) && isset($settings['logo']))
                    document.getElementById("crop-logo-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchLogoCropTool(document.getElementById("img_logo_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getLogoImages() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-logo-container');
                let images = [];
                $("#cropped_logo_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "logo").val(container[0].children[i].children[0].src);
                    $("#cropped_logo_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>
<script>
    //header1
        var fileHeader1Input = document.querySelector('#file-input-header1');
        var previewHeader1Container = document.querySelector('.preview-header1-container');
        var croppieHeader1Modal = document.querySelector('#croppie-header1-modal');
        var croppieHeader1Container = document.querySelector('#croppie-header1-container');
        var croppieHeader1CancelBtn = document.querySelector('#croppie-header1-cancel-btn');
        var croppieHeader1SubmitBtn = document.querySelector('#croppie-header1-submit-btn');
        // let currentFiles = [];
        fileHeader1Input.addEventListener('change', () => {
            previewHeader1Container.innerHTML = '';
            let files = Array.from(fileHeader1Input.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHeader1Images()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#header1Modal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHeader1CropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHeader1Container.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHeader1Images()
        });
        function launchHeader1CropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
             viewport: {
                width: 600, // Width for a 3:1 ratio
                height: 200, // Height for a 3:1 ratio
                type: 'square' // Can also be 'rectangle'
                },
                boundary: {
                width: 650,
                height: 250,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHeader1Container, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHeader1Modal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHeader1CancelBtn.addEventListener('click', () => {
                croppieHeader1Modal.style.display = 'none';
                $('#header1Modal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHeader1SubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                     width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHeader1Modal.style.display = 'none';
                    $('#header1Modal').modal('hide');
                    croppie.destroy();
                    getHeader1Images()
                });
            });
        }
                // edit Case
                @if (!empty($header1) && isset($settings['header1']))
                    document.getElementById("crop-header1-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHeader1CropTool(document.getElementById("img_header1_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHeader1Images() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-header1-container');
                let images = [];
                $("#cropped_header1_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "header1").val(container[0].children[i].children[0].src);
                    $("#cropped_header1_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>
<script>
    //header2
        var fileHeader2Input = document.querySelector('#file-input-header2');
        var previewHeader2Container = document.querySelector('.preview-header2-container');
        var croppieHeader2Modal = document.querySelector('#croppie-header2-modal');
        var croppieHeader2Container = document.querySelector('#croppie-header2-container');
        var croppieHeader2CancelBtn = document.querySelector('#croppie-header2-cancel-btn');
        var croppieHeader2SubmitBtn = document.querySelector('#croppie-header2-submit-btn');
        // let currentFiles = [];
        fileHeader2Input.addEventListener('change', () => {
            previewHeader2Container.innerHTML = '';
            let files = Array.from(fileHeader2Input.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHeader2Images()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#header2Modal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHeader2CropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHeader2Container.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHeader2Images()
        });
        function launchHeader2CropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
             viewport: {
                width: 600, // Width for a 3:1 ratio
                height: 200, // Height for a 3:1 ratio
                type: 'square' // Can also be 'rectangle'
                },
                boundary: {
                width: 650,
                height: 250,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHeader2Container, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHeader2Modal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHeader2CancelBtn.addEventListener('click', () => {
                croppieHeader2Modal.style.display = 'none';
                $('#header2Modal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHeader2SubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                     width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHeader2Modal.style.display = 'none';
                    $('#header2Modal').modal('hide');
                    croppie.destroy();
                    getHeader2Images()
                });
            });
        }
                // edit Case
                @if (!empty($header2) && isset($settings['header2']))
                    document.getElementById("crop-header2-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHeader2CropTool(document.getElementById("img_header2_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHeader2Images() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-header2-container');
                let images = [];
                $("#cropped_header2_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "header2").val(container[0].children[i].children[0].src);
                    $("#cropped_header2_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>

<script>
    //header3
        var fileHeader3Input = document.querySelector('#file-input-header3');
        var previewHeader3Container = document.querySelector('.preview-header3-container');
        var croppieHeader3Modal = document.querySelector('#croppie-header3-modal');
        var croppieHeader3Container = document.querySelector('#croppie-header3-container');
        var croppieHeader3CancelBtn = document.querySelector('#croppie-header3-cancel-btn');
        var croppieHeader3SubmitBtn = document.querySelector('#croppie-header3-submit-btn');
        // let currentFiles = [];
        fileHeader3Input.addEventListener('change', () => {
            previewHeader3Container.innerHTML = '';
            let files = Array.from(fileHeader3Input.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHeader3Images()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#header3Modal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHeader3CropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHeader3Container.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHeader3Images()
        });
        function launchHeader3CropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
             viewport: {
                width: 600, // Width for a 3:1 ratio
                height: 200, // Height for a 3:1 ratio
                type: 'square' // Can also be 'rectangle'
                },
                boundary: {
                width: 650,
                height: 250,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHeader3Container, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHeader3Modal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHeader3CancelBtn.addEventListener('click', () => {
                croppieHeader3Modal.style.display = 'none';
                $('#header3Modal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHeader3SubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                     width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHeader3Modal.style.display = 'none';
                    $('#header3Modal').modal('hide');
                    croppie.destroy();
                    getHeader3Images()
                });
            });
        }
                // edit Case
                @if (!empty($header3) && isset($settings['header3']))
                    document.getElementById("crop-header3-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHeader3CropTool(document.getElementById("img_header3_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHeader3Images() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-header3-container');
                let images = [];
                $("#cropped_header3_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "header3").val(container[0].children[i].children[0].src);
                    $("#cropped_header3_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>

<script>
    //header4
        var fileHeader4Input = document.querySelector('#file-input-header4');
        var previewHeader4Container = document.querySelector('.preview-header4-container');
        var croppieHeader4Modal = document.querySelector('#croppie-header4-modal');
        var croppieHeader4Container = document.querySelector('#croppie-header4-container');
        var croppieHeader4CancelBtn = document.querySelector('#croppie-header4-cancel-btn');
        var croppieHeader4SubmitBtn = document.querySelector('#croppie-header4-submit-btn');
        // let currentFiles = [];
        fileHeader4Input.addEventListener('change', () => {
            previewHeader4Container.innerHTML = '';
            let files = Array.from(fileHeader4Input.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHeader4Images()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#header4Modal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHeader4CropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHeader4Container.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHeader4Images()
        });
        function launchHeader4CropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
             viewport: {
                width: 600, // Width for a 3:1 ratio
                height: 200, // Height for a 3:1 ratio
                type: 'square' // Can also be 'rectangle'
                },
                boundary: {
                width: 650,
                height: 250,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHeader4Container, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHeader4Modal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHeader4CancelBtn.addEventListener('click', () => {
                croppieHeader4Modal.style.display = 'none';
                $('#header4Modal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHeader4SubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                     width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHeader4Modal.style.display = 'none';
                    $('#header4Modal').modal('hide');
                    croppie.destroy();
                    getHeader4Images()
                });
            });
        }
                // edit Case
                @if (!empty($header4) && isset($settings['header4']))
                    document.getElementById("crop-header4-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHeader4CropTool(document.getElementById("img_header4_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHeader4Images() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-header4-container');
                let images = [];
                $("#cropped_header4_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "header4").val(container[0].children[i].children[0].src);
                    $("#cropped_header4_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>
<script>
    //header5
        var fileHeader5Input = document.querySelector('#file-input-header5');
        var previewHeader5Container = document.querySelector('.preview-header5-container');
        var croppieHeader5Modal = document.querySelector('#croppie-header5-modal');
        var croppieHeader5Container = document.querySelector('#croppie-header5-container');
        var croppieHeader5CancelBtn = document.querySelector('#croppie-header5-cancel-btn');
        var croppieHeader5SubmitBtn = document.querySelector('#croppie-header5-submit-btn');
        // let currentFiles = [];
        fileHeader5Input.addEventListener('change', () => {
            previewHeader5Container.innerHTML = '';
            let files = Array.from(fileHeader5Input.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHeader5Images()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#header5Modal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHeader5CropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHeader5Container.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHeader5Images()
        });
        function launchHeader5CropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
             viewport: {
                width: 600, // Width for a 3:1 ratio
                height: 200, // Height for a 3:1 ratio
                type: 'square' // Can also be 'rectangle'
                },
                boundary: {
                width: 650,
                height: 250,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHeader5Container, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHeader5Modal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHeader5CancelBtn.addEventListener('click', () => {
                croppieHeader5Modal.style.display = 'none';
                $('#header5Modal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHeader5SubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                     width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHeader5Modal.style.display = 'none';
                    $('#header5Modal').modal('hide');
                    croppie.destroy();
                    getHeader5Images()
                });
            });
        }
                // edit Case
                @if (!empty($header5) && isset($settings['header5']))
                    document.getElementById("crop-header5-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHeader5CropTool(document.getElementById("img_header5_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHeader5Images() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-header5-container');
                let images = [];
                $("#cropped_header5_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "header5").val(container[0].children[i].children[0].src);
                    $("#cropped_header5_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>

<script>
    //header6
        var fileHeader6Input = document.querySelector('#file-input-header6');
        var previewHeader6Container = document.querySelector('.preview-header6-container');
        var croppieHeader6Modal = document.querySelector('#croppie-header6-modal');
        var croppieHeader6Container = document.querySelector('#croppie-header6-container');
        var croppieHeader6CancelBtn = document.querySelector('#croppie-header6-cancel-btn');
        var croppieHeader6SubmitBtn = document.querySelector('#croppie-header6-submit-btn');
        // let currentFiles = [];
        fileHeader6Input.addEventListener('change', () => {
            previewHeader6Container.innerHTML = '';
            let files = Array.from(fileHeader6Input.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHeader6Images()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#header6Modal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHeader6CropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHeader6Container.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHeader6Images()
        });
        function launchHeader6CropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
             viewport: {
                width: 600, // Width for a 3:1 ratio
                height: 200, // Height for a 3:1 ratio
                type: 'square' // Can also be 'rectangle'
                },
                boundary: {
                width: 650,
                height: 250,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHeader6Container, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHeader6Modal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHeader6CancelBtn.addEventListener('click', () => {
                croppieHeader6Modal.style.display = 'none';
                $('#header6Modal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHeader6SubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                     width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHeader6Modal.style.display = 'none';
                    $('#header6Modal').modal('hide');
                    croppie.destroy();
                    getHeader6Images()
                });
            });
        }
                // edit Case
                @if (!empty($header6) && isset($settings['header6']))
                    document.getElementById("crop-header6-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHeader6CropTool(document.getElementById("img_header6_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHeader6Images() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-header6-container');
                let images = [];
                $("#cropped_header6_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "header6").val(container[0].children[i].children[0].src);
                    $("#cropped_header6_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>

<script>
    //header7
        var fileHeader7Input = document.querySelector('#file-input-header7');
        var previewHeader7Container = document.querySelector('.preview-header7-container');
        var croppieHeader7Modal = document.querySelector('#croppie-header7-modal');
        var croppieHeader7Container = document.querySelector('#croppie-header7-container');
        var croppieHeader7CancelBtn = document.querySelector('#croppie-header7-cancel-btn');
        var croppieHeader7SubmitBtn = document.querySelector('#croppie-header7-submit-btn');
        // let currentFiles = [];
        fileHeader7Input.addEventListener('change', () => {
            previewHeader7Container.innerHTML = '';
            let files = Array.from(fileHeader7Input.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);
                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getHeader7Images()
                                }
                            });
                        });
                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#header7Modal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchHeader7CropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewHeader7Container.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }

            getHeader7Images()
        });
        function launchHeader7CropTool(img) {
            // Set up Croppie options
            var croppieOptions = {
             viewport: {
                width: 600, // Width for a 3:1 ratio
                height: 200, // Height for a 3:1 ratio
                type: 'square' // Can also be 'rectangle'
                },
                boundary: {
                width: 650,
                height: 250,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            var croppie = new Croppie(croppieHeader7Container, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieHeader7Modal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieHeader7CancelBtn.addEventListener('click', () => {
                croppieHeader7Modal.style.display = 'none';
                $('#header7Modal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieHeader7SubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                     width:1350,
                        height: 450
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieHeader7Modal.style.display = 'none';
                    $('#header7Modal').modal('hide');
                    croppie.destroy();
                    getHeader7Images()
                });
            });
        }
                // edit Case
                @if (!empty($header7) && isset($settings['header7']))
                    document.getElementById("crop-header7-btn").addEventListener('click', () => {

                        console.log(("#exampleModal"))
                        setTimeout(() => {
                            launchHeader7CropTool(document.getElementById("img_header7_footer"));
                        }, 500);
                    });
                    document.getElementById("deleteBtn").addEventListener('click', () => {
                        if (window.confirm('Are you sure you want to delete this image?')) {
                            $("#preview").remove();
                        }
                    });
            @endif
        function getHeader7Images() {
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-header7-container');
                let images = [];
                $("#cropped_header7_images").empty();
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "header7").val(container[0].children[i].children[0].src);
                    $("#cropped_header7_images").append(newInput);
                }
                return images
            }, 300);
        }

</script>

@endsection
