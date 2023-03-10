@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')

    <div class="content-wrapper dashboard-wrapper mt-30">

        <!-- Main content -->
        <section class="content p-0">
            <div class="container-fluid table-filter-container border-radius-5 p-imp-30">

                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                <h5 class="fm-poppins m-0 text-dark">{{ @$data['title'] }}</h5>
                <div class="d-flex align-items-center flex-wrap">

                    <a href="{{ route('notice.pushNotification') }}"
                        class="btn btn-sm btn-primary mb-2">{{ _trans('common.New') }}
                    </a>
                </div>
                </div>

                @if (hasPermission('leave_assign_read'))
                    <div class="row dataTable-btButtons">
                        <div class="col-lg-12">
                            <table id="table" class="table card-table table-vcenter datatable mb-0 w-100 push_notification_table">
                                <thead>
                                    <tr>
                                        <th>{{ _trans('common.Title') }}</th>
                                        <th>{{ _trans('common.Message') }}</th>
                                        <th>{{ _trans('common.Date') }}</th>
                                        <th>{{ _trans('common.Type') }}</th>
                                        <th>{{ _trans('common.Action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </section>


    </div>
    <input type="hidden" name="" id="push_notification_data_url" value="{{$data['url'] }}">
@endsection

@section('script')
    @include('backend.partials.datatable')
@endsection
