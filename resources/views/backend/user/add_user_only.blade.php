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

        <!-- Main content -->
        <section class="content ">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('user.store') }}"
                                enctype="multipart/form-data">
                              @csrf
                              <div class="row  ">
                                  <div class="col-md-12">
                                      <div class="float-right mb-3  text-right">
                                          @if(hasPermission('role_read'))
                                              <a href="{{ route('user.index') }}"
                                                 class="btn btn-primary"> <i
                                                          class="fa fa-arrow-left"></i> {{ _trans('common.Back') }}</a>
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
                                                     placeholder="{{ _trans('common.Name') }}" value="{{ old('name') }}"
                                                     required>
                                              @if ($errors->has('name'))
                                                  <div class="error">{{ $errors->first('name') }}</div>
                                              @endif
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="name" class="cus-label">{{ _trans('common.Email') }}</label>
                                              <input type="email"
                                                     name="email"
                                                     placeholder="{{ _trans('common.Email') }}"
                                                             autocomplete="off"
                                                     class="form-control" value="{{ old('email') }}" required>
                                              @if ($errors->has('email'))
                                                  <div class="error">{{ $errors->first('email') }}</div>
                                              @endif
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="name" class="cus-label">{{ _trans('common.Phone') }}</label>
                                              <input type="number"
                                                     name="phone"
                                                     placeholder="{{ _trans('common.Phone') }}"
                                                             autocomplete="off"
                                                     class="form-control" value="{{ old('phone') }}" required>
                                              @if ($errors->has('phone'))
                                                  <div class="error">{{ $errors->first('phone') }}</div>
                                              @endif
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="name"
                                                     class="cus-label">{{ _trans('common.Department') }}</label> <a
                                                      href="{{ route('department.create') }}" target="_blank">{{ _trans('common.Add department') }} </a>
                                              <select name="department_id" class="form-control"
                                                      required>
                                                  <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                  @foreach ( $data['departments'] as $department)
                                                      <option value="{{$department->id}}">{{ $department->title}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="name">{{ _trans('common.Address') }}</label>
                                              <input type="text"
                                                     name="address"
                                                     placeholder={{ _trans('common.Address') }}
                                                             autocomplete="off"
                                                     class="form-control" value="{{ old('address') }}">
                                              @if ($errors->has('address'))
                                                  <div class="error">{{ $errors->first('address') }}</div>
                                              @endif
                                          </div>
                                      </div>

                                 

                                

                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="name"
                                                     class="cus-label">{{ _trans('common.Basic Salary') }}</label>
                                              <input type="number"
                                                     name="basic_salary"
                                                     placeholder="{{ _trans('common.Salary') }}"
                                                             autocomplete="off"
                                                     class="form-control" value="{{ old('basic_salary') }}" required>
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
                                                    <option value="1" {{ old('is_free_location') == 1 ? 'selected' : '' }}>
                                                        {{ _trans('common.Yes') }}</option>
                                                    <option value="0" {{ old('is_free_location') == 0 ? 'selected' : '' }}>
                                                        {{ _trans('common.No') }}</option>
                                                </select>
                                                @if ($errors->has('is_free_location'))
                                                    <div class="error">{{ $errors->first('is_free_location') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                     

                                  </div>
                                  {{-- 2nd --}}
                                  <div class="col-md-4">
                                      <div class="col-md-12 mt-3">
                                          <div class="form-group">
                                              <label for="name" class="cus-label">{{ _trans('common.Role') }}</label> <a
                                                      href="{{ route('roles.create') }}" target="_blank">{{ _trans('common.Add role') }} </a>
                                              <select name="role_id" class="form-control change-role" required>
                                                  <option value="" disabled
                                                          selected>{{ _trans('common.Choose One') }}</option>
                                                  @foreach ($data['roles'] as $role)
                                                      <option value="{{$role->id}}">{{ $role->name}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="joining_date"
                                                   class="cus-label">{{ _trans('common.Joining Date') }}</label>
                                            <input type="date"
                                                   name="joining_date"
                                                   autocomplete="off"
                                                   class="form-control" value="{{ old('joining_date') }}" required>
                                            @if ($errors->has('joining_date'))
                                                <div class="error">{{ $errors->first('joining_date') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="designation_id"
                                                   class="cus-label">{{ _trans('common.Designation') }}</label> <a
                                                    href="{{ route('designation.create') }}" target="_blank">{{ _trans('common.Add designation') }}</a>
                                            <select name="designation_id" class="form-control"
                                                    required>
                                                <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                @foreach ( $data['designations'] as $designation)
                                                    <option value="{{$designation->id}}">{{ $designation->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="name" class="cus-label">{{ _trans('common.Gender') }}</label>
                                            <select name="gender" required
                                                    class="form-control demo-select2-placeholder {{ $errors->has('gender') ? 'is-invalid' : ''}}">
                                                <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                <option value="Male" {{old('gender') == 0?'selected':''}}>{{_trans('common.Male')}}</option>
                                                <option value="Female" {{old('gender') == 1?'selected':''}}>{{_trans('common.Female')}}</option>
                                                <option value="Unisex" {{old('gender') == 2?'selected':''}}>{{_trans('common.Unisex')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="marital_status">{{ _trans('common.Marital Status') }}</label>
                                            <select name="marital_status" id="religion" class="form-control">
                                                <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                <option value="Married" {{old('marital_status') == 'Married'?'selected':''}}>{{_trans('common.Married')}}</option>
                                                <option value="Unmarried" {{old('marital_status') == 'Unmarried'?'selected':''}}>{{_trans('common.Unmarried')}}</option>
                                                <option value="Common-Law/Live-In" {{ old('marital_status') ==
                                                    'Common-Law/Live-In'?'selected':''}}>{{_trans('common.Common-Law/Live-In')}}
                                                </option>
                                                <option value="Widowed" {{ old('marital_status') ==
                                                    'Widowed'?'selected':''}}>{{_trans('common.Widowed')}}
                                                </option>
                                                <option value="Separated" {{ old('marital_status') ==
                                                    'Separated'?'selected':''}}>{{_trans('common.Separated')}}
                                                </option>
                                            </select>
                                            @if ($errors->has('marital_status'))
                                                <div class="error">{{ $errors->first('marital_status') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="blood_group">{{ _trans('common.Blood Group') }}</label>
                                            <select name="blood_group" class="form-control">
                                                <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                <option value="A+" {{old('blood_group') == 'A+'?'selected':''}}>A+
                                                </option>
                                                <option value="A-" {{old('blood_group') == 'A-'?'selected':''}}>A-
                                                </option>
                                                <option value="B+" {{old('blood_group') == 'B+'?'selected':''}}>B+
                                                </option>
                                                <option value="B-" {{old('blood_group') == 'B-'?'selected':''}}>B-
                                                </option>
                                                <option value="O+" {{old('blood_group') == 'O+'?'selected':''}}>O+
                                                </option>
                                                <option value="O-" {{old('blood_group') == 'O-'?'selected':''}}>O-
                                                </option>
                                                <option value="AB+" {{old('blood_group') == 'AB+'?'selected':''}}>
                                                    AB+
                                                </option>
                                                <option value="AB-" {{old('blood_group') == 'AB-'?'selected':''}}>
                                                    AB-
                                                </option>
                                            </select>
                                            @if ($errors->has('blood_group'))
                                                <div class="error">{{ $errors->first('blood_group') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    @if(checkFeature('user_wise_location_binds'))
                                        <div class="col-md-12" id="location_list" style="display: {{ old('is_free_location') == 1 ? 'none' : '' }}">
                                            <div class="form-group mb-3">
                                                <label for="name"
                                                    class="form-label">{{ _trans('common.Location') }} <span class="text-danger">*</span></label>
                                                <select name="location_id" id="location_id" class="form-select ot-input select2">
                                                    <option value="">{{ _trans('common.Choose Location') }}</option>
                                                    @foreach ($data['locations'] as $location)
                                                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->address }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('location_id'))
                                                    <div class="error">{{ $errors->first('location_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                  </div>
                                  {{-- 3rd --}}
                                  <div class="col-md-4">
                                    <div class="col-md-12 mt-3">
                                          <div class="form-group">
                                              <label for="name" class="cus-label"> {{ _trans('common.Country') }} </label>
                                              <select name="country" class="form-control select2" id="_country_id" required style="width: 100%"></select>
                                                @if ($errors->has('country'))
                                                    <div class="error">{{ $errors->first('country') }}</div>
                                                @endif
                                          </div>
                                      </div>
                                      <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="shift_id"
                                                   class="cus-label">{{ _trans('common.Shift') }}</label>
                                            <select name="shift_id" class="form-control"
                                                    required>
                                                <option value="" disabled>{{ _trans('common.Choose One') }}</option>
                                                @foreach ( $data['shifts'] as $shift)
                                                    <option value="{{$shift->id}}">{{ $shift->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="gender">{{ _trans('common.Date Of Birth') }}</label>
                                            <input type="date"
                                                   name="birth_date"
                                                   autocomplete="off"
                                                   class="form-control" value="{{ old('birth_date') }}">
                                            @if ($errors->has('birth_date'))
                                                <div class="error">{{ $errors->first('birth_date') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="gender">{{ _trans('common.Religion') }}</label>

                                            <select name="religion" id="religion" class="form-control">
                                                <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                                <option value="Islam" {{old('religion') == 'Islam'?'selected':''}}>
                                                     {{ _trans('common.Islam') }}
                                                </option>
                                                <option value="Hindu" {{old('religion') == 'Hindu'?'selected':''}}>
                                                     {{ _trans('common.Hindu') }}
                                                </option>
                                                <option value="Christian" {{old('religion') == 'Christian'?'selected':''}}>
                                                     {{ _trans('common.Christian') }}
                                                </option>
                                                <option value="Buddha" {{old('religion') == 'Buddha'?'selected':''}}>
                                                     {{ _trans('common.Buddha') }}
                                                </option>
                                            </select>
                                            @if ($errors->has('religion'))
                                                <div class="error">{{ $errors->first('religion') }}</div>
                                            @endif
                                        </div>
                                    </div> 
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="name" class="cus-label">{{ _trans('common.Password') }}</label>
                                            <input type="password"
                                                   name="password"
                                                   placeholder="{{ _trans('common.Password') }}"
                                                           autocomplete="off"
                                                   class="form-control" value="{{ old('password') }}" required>
                                            @if ($errors->has('password'))
                                                <div class="error">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="name"
                                                   class="cus-label">{{ _trans('common.Confirm Password') }}</label>
                                            <input type="password"
                                                   name="password_confirmation"
                                                   placeholder="{{ _trans('common.Confirm Password') }}"
                                                   autocomplete="off"
                                                   class="form-control" value="{{ old('password_confirmation') }}"
                                                   required>
                                            @if ($errors->has('password_confirmation'))
                                                <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 text-right mt-4 mr-5">
                                    <div class="form-group">
                                        @if(hasPermission('user_create'))
                                            <button type="submit"
                                                    class="btn btn-sm btn-primary mr-3">{{ _trans('common.Submit') }}</button>
                                        @endif
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
<script src="{{url('public/backend/js/pages/__profile.js')}}"></script>
@endsection

