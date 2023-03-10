@extends('backend.layouts.app')
@section('title', _trans('announcement.Notice Details View'))
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ @$data['show']->subject }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                        href="{{ url('hrm/notification') }}">{{ _trans('common.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ _trans('announcement.Notification Details') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="row mb-10">

                                    <div class=" col-12">
                                        <div class="float-sm-right mb-3  ">
                                            <a href="{{ url('hrm/notification') }}" class="btn btn-primary "> <i class="fa fa-arrow-left pr-2"></i>  {{ _trans('common.Back') }}</a>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                       @php
                                           $notification=json_decode($data['show']['data']);
                                       @endphp
                                        <h5>
                                           {{ _trans('common.Title') }}:  {{ @$notification->title }}
                                        </h5>
                                        <p>
                                           {{ _trans('common.Date') }}: {{ showDate(@$data['show']->created_at) }}
                                        </p>
                                        <p>
                                            {{ @$notification->body }}
                                        </p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
