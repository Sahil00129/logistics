<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\models\UserPermission;
use App\models\Permission;
use Auth;
use Session;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $geturlslug = \Request::segment(2);

        $getpermissionid = Permission::where('name',$geturlslug)->first();
        $getuserpermissions = UserPermission::where('user_id',$user->id)->pluck('permisssion_id')->ToArray();
        
        if(!empty($getuserpermissions)){
            if(!empty($getpermissionid->id)){
                if(in_array($getpermissionid->id, $getuserpermissions)){
                    return $next($request);    
                }else{
                    return redirect('/forbidden-error');
                } 

            }else{
                return $next($request);        
            }
        }else{  
            return $next($request);    
        }
        return $next($request);
    }
}
