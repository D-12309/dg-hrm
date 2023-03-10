@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')

    <div class="content-wrapper dashboard-wrapper mt-30">

        <!-- Main content -->
        <section class="content p-0">
            <div class="container-fluid table-filter-container border-radius-5 p-imp-30">
                <div class="row mb-20">
                    <div class="col-lg-12 d-flex">
                        <div class="col-lg-6">
                            <h5 class="fm-poppins m-0 text-dark">{{ @$data['title'] }}</h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <a href="{{ route('hrm.payroll_advance_type.create') }}" class="btn btn-primary ">{{ _trans('common.Create') }}</a> 
                            @if(@$data['commission'])
                                <a href="{{ route('hrm.payroll_advance_type.index') }}" class="btn btn-primary "> <i class="fa fa-arrow-left pr-2"></i> {{ _trans('common.Back') }}</a>  
                            @else
                                <a href="{{ route('hrm.payroll_advance_salary.index') }}" class="btn btn-primary ">{{ _trans('common.Advance List') }}</a>  
                            @endif 
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                    <h5 class="fm-poppins m-0 text-dark">{{ @$data['title'] }}</h5>
                    @if(@$data['commission'])
                        <a href="{{ route('hrm.payroll_advance_type.index') }}" class="btn btn-primary "> <i
                                class="fa fa-arrow-left pr-2"></i> {{ _trans('common.Back') }}</a>  
                    @else
                        <a href="{{ route('hrm.payroll_advance_salary.index') }}" class="btn btn-primary ">{{ _trans('common.Advance List') }}</a>  
                    @endif                     
                </div> --}}

                <div class="row dataTable-btButtons">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table"
                                    class="table card-table table-vcenter datatable mb-0 w-100 payroll_advance_type_table">
                                    <thead>
                                        <tr>
                                            <th>{{ _trans('common.Name') }}</th>
                                            <th>{{ _trans('common.Status') }}</th>
                                            <th class="">{{ _trans('common.Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <input type="text" hidden id="payroll_advance_type_data_url" value="{{ route('hrm.payroll_advance_type.datatable') }}">
@endsection
@section('script')
    @include('backend.partials.datatable')
@endsection
