@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('style')
    <style>
        .icon-upload{
            display: flex;
            justify-content: center;
        }

        .icon-upload .sizing{
            position: relative;
            width: 80px;
            height: 80px;
        }

        .icon-upload .sizing img {
            border: 3px solid #adb5bd;
            border-radius: 10px;
            margin: 0 auto;
            padding: 1px;
            width: 80px !important;
            height: 80px !important;
        }

        .icon-upload .sizing label{
            position: absolute;
            top: 50px;
            right: 1px;
        }

        .download-icon {
            border-radius: 7px;
            width: 28px;
            height: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #7f58fea3;
        }

        .download-icon i {
            color: #fff;

        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper cus-content-wrapper">
        <!-- Main content -->
        <div class="container-fluid border-radius-5 p-imp-30">
            <div class="row mt-4">
                <div class="offset-md-2 col-md-8 pr-md-2">
                    <div class="card card-with-shadow border-0">
                        <div class="px-primary py-primary">
                            <h4>{{ _trans('settings.App Screen Setup') }}</h4>
                            <hr>
                            <div id="General-0">
                                <fieldset class="form-group mb-5">

                                    <ul id="app_screen_sortable"> 
                                        @foreach ($data['settings'] as $setting) 
                                            <li class="default mt-2 app_menu" id="{{ $setting->id }}">
                                                <div class="row">
                                                    <div class="col-lg-12 d-flex">
                                                        <div class="col-lg-1">
                                                            <span id="show_position{{ $setting->id }}">{{ $setting->position }}</span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <form action="{{ route('appSettingsIcon') }}" method="POST" enctype="multipart/form-data" id="icon-settings{{$setting->id}}">
                                                                @csrf
                                                                <div class="icon-upload">
                                                                    <div class="sizing">
                                                                        <img class="p-2" src="{{ my_asset($setting->icon) }}" >
                                                                        <label for="icon{{ $setting->id }}" class="download-icon">
                                                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input type="hidden" name="id" value="{{ $setting->id }}" />
                                                                        <input type="file" accept=".png, .jpg, .jpeg,.svg" id='icon{{ $setting->id }}' name="icon" hidden="true" onchange="submit()"/>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <form action="{{ route('appSettingsTitle') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                    <input name="id" type="hidden" value="{{ $setting->id }}">
                                                                    <input name="title" type="text" class="form-control" value="{{ $setting->name }}">
                                                                </form>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="switch">
                                                                <input type="checkbox" class="setup_switch"
                                                                    data-name="{{ $setting->name }}"
                                                                    data-id="{{ $setting->id }}" name="{{ $setting->name }}"
                                                                    {{ $setting->status_id == 1 ? 'checked' : '' }}
                                                                    value=" {{ $setting->status_id == 1 ? 1 : '' }}">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </li>
                                        @endforeach  
                                     </ul> 


                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="appScreenSetupUpdate" value="{{ route('appScreenSetupUpdate') }}">
    <input type="hidden" id="AppScreenSortable" value="{{ route('AppScreenSortable') }}">
    <input type="hidden" id="token" value="{{ csrf_token() }}">
@endsection
