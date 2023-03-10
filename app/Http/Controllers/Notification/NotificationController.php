<?php

namespace App\Http\Controllers\Notification;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class NotificationController extends Controller
{
    public function index()
    {
        $data['title'] = _trans('common.Notification');
        return view('backend.notification.index', compact('data'));
    }

    //readNotification
    public function readNotification(Request $request)
    {
        try {
            $notification = auth()->user()->unreadNotifications->where('id', $request->id)->first();
            if ($notification->read_at == null) {
                $notification->markAsRead();
            }
            $action_url= $notification->data['actionURL']['web'];
            $data=[];
            $data['action_url'] = $action_url;
            $data['notification'] = $notification;
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
    public function details($id)
    {
        try {
            $notification=Notification::find($id);
            $data['show'] = $notification;
            $data['title']=_trans('common.Notification Details');
            return view('backend.notification.view', compact('data'));
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong!'), 'Error');
            return redirect()->back();
        }
    }
    public function delete($id)
    {
        try {
            $notification=Notification::find($id);
            $notification->delete();
            Toastr::success(_trans('response.Notification Deleted successfully'), 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong!'), 'Error');
            return redirect()->back();
        }
    }
}
