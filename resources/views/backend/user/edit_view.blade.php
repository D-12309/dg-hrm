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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{
                                _trans('common.Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ @$data['title'] }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <!-- Main content -->
    <section class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" id="userEditForm" action="{{ route('user.update',$data['show']->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $data['show']->id }}">
                                <div class="row">
                                    <div class=" col-12">
                                        <div class="float-right mb-3  text-right">
                                            @if(hasPermission('role_read'))
                                            <a href="{{ route('user.index') }}" class="btn btn-primary"> <i
                                                    class="fa fa-arrow-left"></i>{{ _trans('common.Back') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.Name') }}</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="{{ _trans('common.Name') }}"
                                                    value="{{ $data['show']->name }}" required>
                                                @if ($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.Email') }}</label>
                                                <input type="email" name="email"
                                                    placeholder="{{ _trans('common.Email') }}" autocomplete="off"
                                                    class="form-control" value="{{ $data['show']->email }}" required>
                                                @if ($errors->has('email'))
                                                <div class="error">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.Phone') }}</label>
                                                <input type="number" name="phone"
                                                    placeholder="{{ _trans('common.Phone') }}" autocomplete="off"
                                                    class="form-control" value="{{ $data['show']->phone }}" required>
                                                @if ($errors->has('phone'))
                                                <div class="error">{{ $errors->first('phone') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="joining_date" class="cus-label">{{ _trans('common.Joining
                                                    Date') }}</label>
                                                <input type="date" name="joining_date" autocomplete="off"
                                                    class="form-control" value="{{ $data['show']->joining_date }}"
                                                    required>
                                                @if ($errors->has('joining_date'))
                                                <div class="error">{{ $errors->first('joining_date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="shift_id" class="cus-label">{{ _trans('common.Shift')
                                                    }}</label>

                                                <select name="shift_id" class="form-control" required>
                                                    <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                    @foreach ($data['shifts'] as $shift)
                                                    <option value="{{$shift->id}}" {{ $data['show']->shift_id ==
                                                        $shift->id ? 'selected':'' }}>{{ $shift->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.Department')
                                                    }}</label> <a href="{{ route('department.create') }}"
                                                    target="_blank">{{ _trans('common.Add department') }}</a>
                                                <select name="department_id" class="form-control" required>
                                                    <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                    @foreach ( $data['departments'] as $department)
                                                    <option value="{{$department->id}}" {{ $data['show']->department_id
                                                        == $department->id ? 'selected':'' }}>{{ $department->title}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="designation_id" class="cus-label">{{
                                                    _trans('common.Designation') }}</label> <a
                                                    href="{{ route('designation.create') }}" target="_blank">{{
                                                    _trans('common.Add designation') }} </a>
                                                <select name="designation_id" class="form-control" required>
                                                    <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                    @foreach ( $data['designations'] as $designation)
                                                    <option value="{{$designation->id}}" {{ $data['show']->
                                                        designation_id == $designation->id ? 'selected':'' }}>{{
                                                        $designation->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.Gender')
                                                    }}</label>
                                                <select name="gender" required
                                                    class="form-control demo-select2-placeholder {{ $errors->has('gender') ? 'is-invalid' : ''}}">
                                                    <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                    <option value="Male" {{ $data['show']->gender ==
                                                        'Male'?'selected':''}}>{{_trans('common.Male')}}</option>
                                                    <option value="Female" {{ $data['show']->gender ==
                                                        'Female'?'selected':''}}>{{_trans('common.Female')}}</option>
                                                    <option value="Unisex" {{ $data['show']->gender
                                                        =='Unisex'?'selected':''}}>{{_trans('common.Unisex')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">{{ _trans('common.Address') }}</label>
                                                <input type="text" name="address"
                                                    placeholder={{_trans('common.Address')}} autocomplete="off"
                                                    class="form-control" value="{{ $data['show']->address }}">
                                                @if ($errors->has('address'))
                                                <div class="error">{{ $errors->first('address') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gender">{{ _trans('common.Date Of Birth') }}</label>
                                                <input type="date" name="birth_date" autocomplete="off"
                                                    class="form-control" value="{{ $data['show']->birth_date }}">
                                                @if ($errors->has('birth_date'))
                                                <div class="error">{{ $errors->first('birth_date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gender">{{ _trans('common.Religion') }}</label>

                                                <select name="religion" id="religion" class="form-control">
                                                    <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                    <option value="Islam" {{ $data['show']->religion ==
                                                        'Islam'?'selected':''}}>
                                                        {{ _trans('common.Islam') }}
                                                    </option>
                                                    <option value="Hindu" {{ $data['show']->religion ==
                                                        'Hindu'?'selected':''}}>
                                                        {{ _trans('common.Hindu') }}
                                                    </option>
                                                    <option value="Christan" {{ $data['show']->religion ==
                                                        'Christan'?'selected':''}}>
                                                        {{ _trans('common.Christan') }}
                                                    </option>
                                                </select>
                                                @if ($errors->has('religion'))
                                                <div class="error">{{ $errors->first('religion') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="marital_status">{{ _trans('common.Marital Status')
                                                    }}</label>
                                                <select name="marital_status" id="religion" class="form-control">
                                                    <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                    <option value="Married" {{ $data['show']->marital_status ==
                                                        'Married'?'selected':''}}>{{_trans('common.Married')}}</option>
                                                    <option value="Unmarried" {{ $data['show']->marital_status ==
                                                        'Unmarried'?'selected':''}}>{{_trans('common.Unmarried')}}
                                                    </option>
                                                    <option value="Common-Law/Live-In" {{ $data['show']->marital_status ==
                                                        'Common-Law/Live-In'?'selected':''}}>{{_trans('common.Common-Law/Live-In')}}
                                                    </option>
                                                    <option value="Widowed" {{ $data['show']->marital_status ==
                                                        'Widowed'?'selected':''}}>{{_trans('common.Widowed')}}
                                                    </option>
                                                    <option value="Separated" {{ $data['show']->marital_status ==
                                                        'Separated'?'selected':''}}>{{_trans('common.Separated')}}
                                                    </option>
                                                </select>
                                                @if ($errors->has('marital_status'))
                                                <div class="error">{{ $errors->first('marital_status') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="blood_group">{{ _trans('common.Blood Group') }}</label>
                                                <select name="blood_group" class="form-control">
                                                    <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                    <option value="A+" {{ $data['show']->blood_group ==
                                                        'A+'?'selected':''}}>
                                                        A+
                                                    </option>
                                                    <option value="A-" {{ $data['show']->blood_group ==
                                                        'A-'?'selected':''}}>
                                                        A-
                                                    </option>
                                                    <option value="B+" {{ $data['show']->blood_group ==
                                                        'B+'?'selected':''}}>
                                                        B+
                                                    </option>
                                                    <option value="B-" {{ $data['show']->blood_group ==
                                                        'B-'?'selected':''}}>
                                                        B-
                                                    </option>
                                                    <option value="O+" {{ $data['show']->blood_group ==
                                                        'O+'?'selected':''}}>
                                                        O+
                                                    </option>
                                                    <option value="O-" {{ $data['show']->blood_group ==
                                                        'O-'?'selected':''}}>
                                                        O-
                                                    </option>
                                                    <option value="AB+" {{ $data['show']->blood_group ==
                                                        'AB+'?'selected':''}}>
                                                        AB+
                                                    </option>
                                                    <option value="AB-" {{ $data['show']->blood_group ==
                                                        'AB-'?'selected':''}}>
                                                        AB-
                                                    </option>
                                                </select>
                                                @if ($errors->has('blood_group'))
                                                <div class="error">{{ $errors->first('blood_group') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.Basic Salary')
                                                    }}</label>
                                                <input type="number" name="basic_salary"
                                                    placeholder="{{ _trans('common.Basic Salary') }}" autocomplete="off"
                                                    class="form-control" value="{{ $data['show']->basic_salary }}"
                                                    required>
                                                @if ($errors->has('basic_salary'))
                                                <div class="error">{{ $errors->first('basic_salary') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                       @if(checkFeature('user_wise_location_binds'))
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label for="name"
                                                        class="form-label">{{ _trans('common.Is free Location?') }} <span class="text-danger">*</span></label>
                                                    <select name="is_free_location" id="is_free_location" class="form-select ot-input select2" required>
                                                        <option value="" disabled>{{ _trans('common.Choose One') }}
                                                        </option>
                                                        <option value="1" {{ $data['show']->is_free_location == 1 ? 'selected' : '' }}>
                                                            {{ _trans('common.Yes') }}</option>
                                                        <option value="0" {{ $data['show']->is_free_location == 0 ? 'selected' : '' }}>
                                                            {{ _trans('common.No') }}</option>
                                                    </select>
                                                    @if ($errors->has('is_free_location'))
                                                        <div class="error">{{ $errors->first('is_free_location') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="location_list" style="display: {{ $data['show']->is_free_location == 1 ? 'none' : '' }}">
                                                <div class="form-group mb-3">
                                                    <label for="name"
                                                        class="form-label">{{ _trans('common.Location') }} <span class="text-danger">*</span></label>
                                                    <select name="location_id" id="location_id" class="form-select ot-input select2">
                                                        <option value="">{{ _trans('common.Choose Location') }}</option>
                                                        @foreach ($data['locations'] as $location)
                                                            <option value="{{ $location->id }}" {{ $data['show']->location_id == $location->id ? 'selected' : '' }}>{{ $location->address }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('location_id'))
                                                        <div class="error">{{ $errors->first('location_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                       @endif
                                        @if(settings('login_method')=='pin')
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.PIN') }}</label>
                                                <input type="number" maxlength="4" maxlength="6" name="pin"
                                                    placeholder="{{ _trans('common.PIN') }}" autocomplete="off"
                                                    class="form-control" value="{{ @$data['show']->pin }}" required>
                                                @if ($errors->has('pin'))
                                                <div class="error">{{ $errors->first('pin') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="name" class="cus-label">{{ _trans('common.Role') }}</label>
                                                <a href="{{ route('roles.create') }}" target="_blank">{{
                                                    _trans('common.Add Role') }}</a>
                                                <select name="role_id" class="form-control {{ settings('user_wise_permission') == null && settings('user_wise_permission') ? 'change-role':''  }}" required>
                                                    <option value="" disabled selected>{{ _trans('common.Choose One') }}
                                                    </option>
                                                    @foreach ($data['roles'] as $role)
                                                    <option value="{{$role->id}}" {{ $data['show']->role_id == $role->id
                                                        ?'selected':'' }}>{{ $role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-inner ">
                                            <table class="table table-striped role-create-table role-permission "
                                                id="permissions-table">
                                                {{-- <thead>
                                                    <tr>
                                                        <th scope="col">{{ _trans('common.Module') }}/ {{
                                                            _trans('common.Sub Module') }}</th>
                                                        <th scope="col">{{ _trans('common.Permissions') }}</th>
                                                    </tr>
                                                </thead> --}}
                                                <tbody>
                                                    <tr>
                                                        <td>{{ _trans('common.Check all') }}</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox"
                                                                    class="custom-control-input read check_all"
                                                                    name="check_all" id="check_all">
                                                                <label class="custom-control-label" for="check_all">{{
                                                                    _trans('common.Check all') }}</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @foreach($data['permissions'] as $parent_key => $permission)
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="row m-0 p-0">
                                                                <div class="col-md-12">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name=""
                                                                            class="custom-control-input read common-key module_all_check"
                                                                            data-id="{{ $parent_key }}"
                                                                            data-target_div="module_permissions{{ $parent_key }}"
                                                                            id="module{{ $parent_key }}">
                                                                        <label class="custom-control-label ml-20 w-100 "
                                                                            for="module{{ $parent_key }}">
                                                                            <a class="btn btn-primary text-left"
                                                                                style="width: 100%"
                                                                                data-toggle="collapse"
                                                                                href="#permission_section{{ $parent_key }}"
                                                                                role="button" aria-expanded="false"
                                                                                aria-controls="permission_section{{ $parent_key }}">
                                                                                <span
                                                                                    class="text-capitalize">{{plain_text($permission->attribute)}}</span>
                                                                            </a>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse mt-2"
                                                                id="permission_section{{ $parent_key }}">
                                                                <div class="card card-body">
                                                                    <div class="row"
                                                                        id="module_permissions{{ $parent_key }}">
                                                                        @foreach($permission->keywords as $key =>
                                                                        $keyword)
                                                                        <div class="col-md-3">
                                                                            <div class="custom-control custom-checkbox">
                                                                                @if($keyword != "")
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input read child_permission common-key permission_check{{ $parent_key }}"
                                                                                    data-parent_id="{{ $parent_key }}"
                                                                                    name="permissions[]"
                                                                                    value="{{$keyword}}"
                                                                                    id="{{$keyword}}" {{$data['show']->permissions != null? in_array($keyword,@$data['show']->permissions)?'checked':'' : ''}}>
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
                                            <div class="row">
                                                <div class="col-md-12 text-right mt-4 mr-5">
                                                    <div class="form-group">
                                                        @if(hasPermission('user_create'))
                                                        <button style="margin-right: 2%" type="submit"
                                                            class="btn btn-sm btn-primary">{{ _trans('common.Submit')
                                                            }}</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script src="{{url('public/backend/js/pages/_transprofile.js')}}"></script>

<script src="{{ asset('public/backend/js/_roles.js') }}"></script>
@endsection