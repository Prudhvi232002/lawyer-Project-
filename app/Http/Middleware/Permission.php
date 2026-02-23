<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$permission)
    {
        $user = Auth::user();
        if($user){
            $permission = $user->hasPermission($permission);
            if(!$permission){
                return redirect(route('super_admin.not_allowed'));
        }
      }else{
        return response()->json([
            'success' => false,
            'message' => 'Invalid Request',
          ], 401);
      }
        return $next($request);
    }
}
