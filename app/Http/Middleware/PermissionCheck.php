<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // return $next($request);
        $system_permissions=null;
        if (auth()->user()->role_id == 1) {
            $system_permissions = auth()->user()->permissions;
        }else{
            if(settings('user_wise_permission') != null && !settings('user_wise_permission')){
                $system_permissions = roleToUserPermission();
            }else{
                $system_permissions = auth()->user()->permissions ?? roleToUserPermission();
            }
        }
        // return $system_permissions;
        if (Auth::check() && in_array($permission, $system_permissions) || auth()->user()->is_admin==1) :
            return $next($request);
        endif;
        return abort(403, 'Access Denied');
    }
}
