<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class AuthPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $method_alias = $request->route()->getAction();
        if (Gate::denies($method_alias['as'], $request)) {
            // return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
            echo "asdasd";
        }
        return $next($request);
    }

    // protected function validate_auth_privilege(Request $request){
    //     $actions = $request->route()->getAction();
    //     return $actions;
    // }
}
