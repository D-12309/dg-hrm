@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ @$data['title'] }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ _trans('common.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ @$data['title'] }}</li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-10">
                                    <div class="col-md-12">
                                        <div class=" col-md-7 mx-auto">
                                            <div class="float-right mb-3  text-right">
                                                @if (hasPermission('department_read'))
                                                    <a href="{{ route('department.index') }}" class="btn btn-primary "> <i
                                                            class="fa fa-arrow-left pr-2"></i> {{ _trans('common.Back') }}</a>
                                                @endif
                                            </div>
                                        </div><!-- /.col -->
                                    </div>
                                </div><!-- /.row -->
                                <form method="POST" action="{{ route('department.update', $data['department']->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="department_id" value="{{ $data['department']->id }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-7 mx-auto">
                                                <div class="form-group">
                                                    <label for="name">{{ _trans('common.Title') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="title" class="form-control"
                                                        placeholder="{{ _trans('common.Title') }}"
                                                        value="{{ $data['department']->title }}" required>
                                                    @if ($errors->has('title'))
                                                        <div class="error">{{ $errors->first('title') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-7 mx-auto">
                                                <div class="form-group">
                                                    <label for="name">{{ _trans('common.Status') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select name="status_id" class="form-control" required>
                                                        <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                        <option value="1"
                                                            {{ $data['department']->status_id == 1 ? 'selected' : '' }}>
                                                            {{ _translate('Active') }}</option>
                                                        <option value="2"
                                                            {{ $data['department']->status_id == 2 ? 'selected' : '' }}>
                                                            {{ _translate('In-active') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-7 mx-auto">
                                                <div class=" float-right">
                                                    <button type="submit"
                                                        class="btn btn-primary action-btn">{{ _trans('common.Update') }}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection