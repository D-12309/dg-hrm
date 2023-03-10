@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')

    <div class="content-wrapper dashboard-wrapper mt-30">

        <!-- Main content -->
        <section class="content p-0">
            <div class="container-fluid table-filter-container border-radius-5 p-imp-30 table-responsive">

                <div class="row align-items-center mb-15">
                    <div class="col-sm-6">
                        <h5 class="fm-poppins m-0 text-dark">{{ @$data['title'] }}</h5>
                    </div>

                    <div class="col-sm-6">
                    </div>
                </div>
                <table class="table mb-0  card-table table-vcenter datatable mb-0 w-100 notification_table no-footer dataTable dtr-inline">
                    <thead>
                        <tr class="border-bottom">
                            <th>{{ _trans('common.Title') }}</th>
                            <th>{{ _trans('common.Published at') }}</th>
                            <th>{{ _trans('common.Action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse (auth()->user()->unreadNotifications as $notification)
                        @php
                            $sender = App\Models\User::find($notification->data['sender_id']);
                        @endphp
                        <tr class="border-bottom" data-notification_row_id="{{$notification->id}}">
                            <td width="50%">
                                <a href="#" data-notification_id="{{$notification->id}}" class="d-flex justify-content-center align-items-center text-decoration-none text-secondary unread_notification_from_all">
                                    <i class="notification-icon fa fa-dropbox"> </i>
                                    {{-- {{ uploaded_asset($sender->avatar_id) }} --}}
                                    <div class="notification-content">
                                        <span class="notification-title font-weight-bold">{{@$notification->data['title']}}</span>
                                        {{-- <div class="muted">{{ Str::limit($notification->data['body'],100) }}</div> --}}
                                    </div>
                                </a>

                            </td>
                            <td width="25%">
                                <div class="notification-time text-left">{{@$notification->created_at->diffForHumans()}}</div>
                            </td>
                            <td width="25%">
                                
                                <div class="flex-nowrap">
                                    <div class="dropdown position-static">
                                        <button class="btn btn-white dropdown-toggle align-text-top action-dot-btn" data-boundary="viewport" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            @if($notification->data['actionURL']['web']!=null) 
                                                <a  target="_blank" href="{{@$notification->data['actionURL']['web']}}" class="dropdown-item">
                                                    {{ _trans('common.Link') }}
                                                </a>
                                            @endif
                                            <a href="{{ route('notification.details',$notification->id) }}" class="dropdown-item">
                                                {{ _trans('common.Details') }}
                                            </a>
                                            <a href="javascript:;" class="dropdown-item" onclick="__globalDelete(`{{$notification->id}}`,`hrm/notification/delete/`)">
                                                {{ _trans('common.Delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="text-center">
                                        <h5 class="text-secondary">{{ _trans('common.No Notification Found') }}</h5>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </section>
    </div>
    <input type="hidden" id="readNotification" value="{{ route('notification.readNotification') }}">
@endsection

@section('script')
    <script src="https://kit.fontawesome.com/d5b31bd2d2.js" crossorigin="anonymous"></script>
    @include('backend.partials.datatable')
@endsection