@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')
    <div class="content-wrapper">
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
        @php
            $role_wise_permission=settings('user_wise_permission') != null && !settings('user_wise_permission') ? 'yes' : 'no';
        @endphp
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('roles.update',$data['role']->id)}}" class="form-validate" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right mb-3  text-right">
                                        @if(hasPermission('company_settings_update'))
                                            <a href="{{ route('permission.update') }}"  class="btn btn-primary "> <i class="fa fa-sync"></i> {{ _trans('settings.Sync Permissions') }}</a>
                                        @endif

                                        @if(hasPermission('role_read'))
                                            <a href="{{ route('user.index') }}"  class="btn btn-primary "> <i class="fa fa-arrow-left"></i> {{ _trans('common.Back') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="{{ $role_wise_permission=='no'?'offset-md-3':'' }} col-md-{{ $role_wise_permission=='yes'?'4':'6' }}">
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label class="form-label cus-label" for="fv-full-name">{{ _trans('common.Name') }} </label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="fv-full-name" name="name"
                                                       required placeholder="{{ _trans('common.Name') }}" value="{{ $data['role']->name }}">
                                            </div>
                                            @if($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-email">{{ _trans('common.Status') }}</label>
                                            <div class="form-control-wrap">
                                                <select name="status_id" id="status_id" class="form-control" required>
                                                    <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                    <option value="1" {{ $data['role']->status_id == 1 ? 'selected' : '' }}>{{ _trans('common.Active') }}</option>
                                                    <option value="2" {{ $data['role']->status_id == 2 ? 'selected' : '' }}>{{ _trans('common.In-active') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($role_wise_permission=='yes')
                                    
                                    <div class="col-md-8">
                                        <div class="card-inner table-responsive">
                                            <table class="table table-striped role-create-table role-permission ">
                                                <thead>
                                                <tr>
                                                    <th scope="col">{{ _trans('common.Module') }}/ {{ _trans('common.Sub Module') }}</th>
                                                <th scope="col">{{ _trans('common.Permissions') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{ _trans('common.Check all') }}</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                    type="checkbox"
                                                                    class="custom-control-input read check_all"
                                                                    name="check_all"
                                                                    id="check_all">
                                                            <label class="custom-control-label"
                                                                for="check_all">{{ _trans('common.Check all') }}</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @foreach($data['permissions'] as $parent_key => $permission)
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="row">
                                                                <div class="col-md-12" >
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="" class="custom-control-input read common-key module_all_check" data-id="{{ $parent_key }}" data-target_div="module_permissions{{ $parent_key }}" id="module{{ $parent_key }}">
                                                                        <label class="custom-control-label ml-20 w-100 "  for="module{{ $parent_key }}">
                                                                            <a class="btn btn-primary text-left" style="width: 100%"  data-toggle="collapse" href="#permission_section{{ $parent_key }}" role="button" aria-expanded="false" aria-controls="permission_section{{ $parent_key }}">
                                                                                <span class="text-capitalize">{{plain_text($permission->attribute)}}</span>
                                                                            </a>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse mt-2" id="permission_section{{ $parent_key }}">
                                                                <div class="card card-body">
                                                                    <div class="row" id="module_permissions{{ $parent_key }}">
                                                                        @foreach($permission->keywords as $key => $keyword)
                                                                            <div class="col-md-3">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    @if($keyword != "")
                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input read child_permission common-key permission_check{{ $parent_key }}"
                                                                                            data-parent_id="{{ $parent_key }}" name="permissions[]" value="{{$keyword}}"
                                                                                            id="{{$keyword}}" {{ in_array($keyword, $data['role']->permissions)? 'checked':''}}>
                                                                                        <label class="custom-control-label"
                                                                                            for="{{$keyword}}">{{Str::title(Str::replace('_',' ',$key))}}</label>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="permissions[]">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right mt-4 mr-5">
                                    <div class="form-group">
                                        @if(hasPermission('role_update'))
                                            <button style="margin-right: 2%" type="submit"
                                                    class="btn btn-sm btn-primary">{{ _trans('common.Submit') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script src="{{ asset('public/backend/js/_roles.js') }}"></script>
@endsection
