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
                                        href="{{ route('admin.dashboard') }}">{{ _trans('common.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ _trans('announcement.Notice Details View') }}</li>
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
                                            @if(hasPermission('notice_list'))
                                                <a href="{{ route('notice.index') }}" class="btn btn-primary "> <i class="fa fa-arrow-left pr-2"></i>  {{ _trans('common.Back') }}</a>
                                        @endif
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <figure class="text-center">
                                            <img src="{{ uploaded_asset($data['show']->attachment_file_id) }}" alt="image" class="">
                                        </figure>
                                        <h5>
                                           {{ _trans('common.Date') }}: {{ showDate(@$data['show']->date) }}
                                        </h5>
                                        <p>
                                            @foreach ($data['show']->noticeDepartments as $department)
                                                <span class="badge badge-primary">{{ $department->department->title }}</span>
                                            @endforeach
                                        </p>
                                        <p>
                                            {{ @$data['show']->description }}
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
