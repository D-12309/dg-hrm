@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')

<div class="content-wrapper dashboard-wrapper mt-30">

    <!-- Main content -->
    <section class="content p-0">
        <div class="container-fluid table-filter-container border-radius-5 p-imp-30">
            {{-- <div class="row w-100">
                <div class="col-lg-3 col-xxl-4">
                    <h5 class="fm-poppins m-0 text-dark">{{ @$data['title'] }}</h5>
                </div>
                <div class="col-lg-9 col-xxl-8">
                    <div class="row w-100">
                        <div class=" col-12 col-md-6 col-lg-4 form-group">
                            <input class="daterange-table-filter" type="text" name="daterange" id="daterange"
                                value="{{ date('m/d/Y') }}-{{ date('m/d/Y') }}" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 form-group">
                            @if (hasPermission('attendance_report_read'))
                            <select name="department" id="department" class="form-control select2">
                                <option value="">{{ _trans('common.Select Department') }}</option>
                                @foreach ($data['departments'] as $department)
                                <option value="{{ $department->id }}">{{ $department->title }}</option>
                                @endforeach

                            </select>
                            @endif
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary attendance_table_form">{{
                                _trans('common.Submit')
                                }}</button>
                        
                        @if (hasPermission('attendance_create'))
                            <a href="{{ route('attendance.check-in') }}" class="btn btn-primary mb-2">{{
                                _trans('attendance.Add attendance') }}</a>
                        @endif
                     </div>
                    </div>

                </div>
            </div> --}}


            
            <div class="row align-items-center mb-15">
                <div class="col-sm-6">
                    <h5 class="fm-poppins m-0 text-dark">{{ @$data['title'] }}</h5>
                </div>

                <div class="col-sm-6">
                </div>
            </div>

            <div class="row align-items-end mb-30 table-filter-data">
                <div class="col-lg-12">
                    @if(hasPermission('attendance_read'))
                        <div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="">{{ _trans('common.Select Date') }}</label>
                                        <input class="daterange-table-filter" type="text" name="daterange" id="daterange"
                                        value="{{ date('m/d/Y') }}-{{ date('m/d/Y') }}" />
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="">{{ _trans('common.Choose Department') }}</label>
                                        <select name="department" id="department" class="form-control select2">
                                            <option value="">{{ _trans('common.Select Department') }}</option>
                                            @foreach ($data['departments'] as $department)
                                            <option value="{{ $department->id }}">{{ $department->title }}</option>
                                            @endforeach
            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 mt-30">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary attendance_table_form">
                                            {{ _trans('common.Submit')}}</button>
                                    
                                        @if (hasPermission('attendance_create'))
                                            <a href="{{ route('attendance.check-in') }}" class="btn btn-primary">
                                            {{_trans('attendance.Add attendance') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <div class="row dataTable-btButtons attendance-list">
                <div class="col-lg-12">
                    <table id="table"
                        class="table card-table table-vcenter datatable mb-0 w-100 attendance_report_table">
                        <thead>
                            <tr>
                                <th>{{ _trans('common.Date') }}</th>
                                <th>{{ _trans('common.Employee') }}</th>
                                <th>{{ _trans('common.Department') }}</th>
                                <th>{{ _trans('attendance.Break') }}</th>
                                <th>{{ _trans('attendance.Break Duration') }}</th>
                                <th width="25%">{{ _trans('attendance.Check-in') }}</th>
                                <th width="25%">{{ _trans('attendance.Check-out') }}</th>
                                <th>{{ _trans('attendance.Hours') }}</th>
                                <th>{{ _trans('attendance.Overtime') }}</th>
                                <th>{{ _trans('common.Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
<input type="text" hidden id="attendance_report_data_url" value="{{ route('attendanceReport.dataTable') }}">

@endsection
@section('script')
@include('backend.partials.datatable')
@endsection