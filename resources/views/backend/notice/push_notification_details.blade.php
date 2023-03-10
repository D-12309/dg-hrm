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
                                                <a href="{{ route('notice.pushNotificationHistory') }}" class="btn btn-primary "> <i class="fa fa-arrow-left pr-2"></i>  {{ _trans('common.Back') }}</a>
                                        @endif
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <tr>
                                                <td style="width: 10%">
                                                    {{ _trans('common.Title') }} 
                                                </td>
                                                <td style="width: 2%">
                                                    :
                                                </td>
                                                <td>
                                                    {{ @$data['show']->title }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 10%">
                                                    {{ _trans('common.Message') }} 
                                                </td>
                                                <td style="width: 2%">
                                                    :
                                                </td>
                                                <td>
                                                    {{ @$data['show']->message }}
                                                </td>
                                            </tr>
                                            
                                        </table>
                                        <h5>
                                           {{ _trans('common.Date') }}: {{ showDate(@$data['show']->created_at) }}
                                        </h5>
                                        <div class="row" style="max-height: 200px; overflow:auto">
                                            <div class="col-lg-12">
                                                @forelse ($data['show']->users as $key => $notice_user)
                                                    <div class="col-lg-4">
                                                      <a target="_blank" class="nav-link" href="{{ url('dashboard/user/show/'.@$notice_user->user->id.'/official') }}">{{ ++$key.'. '. @$notice_user->user->name }}</a>  
                                                    </div>
                                                @empty
                                                    {{ _trans('common.Sent To All Users') }}
                                                @endforelse
                                            </div>
                                        </div>

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
