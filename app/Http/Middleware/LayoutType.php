<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\M_pengguna;
class LayoutType
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

        $hasil = M_pengguna::with('setting')->where('id',Auth::user()->id)->get();
        foreach ($hasil as $val) {
            $setting =  $val->toArray();
            $layout_type = $setting['setting']['app_layout'];
            $theme = $setting['setting']['app_theme'];
        }
        $request->attributes->add(['layout' => $layout_type,'theme'=>$theme]);
        
        return $next($request);
    }
}
