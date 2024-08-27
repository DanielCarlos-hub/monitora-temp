<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminUserProfileMiddleware
{
    protected $redirects = [
        'admin' => 'dashboard.admin.home',
        'monitoramento' => 'dashboard.monitoramento.home',
    ];

    protected $route;

    public function handle(Request $request, Closure $next)
    {

        $this->route = explode('.', $request->route()->getName());

        if (!Auth::guard('admin')->check()) {
            return redirect()->route('auth.login');
        }

        if(array_key_exists(Auth::guard('admin')->user()->perfil, $this->redirects)){

            if(Auth::guard('admin')->user()->perfil == $this->route[1]){
                return $next($request);
            }

        }

        return redirect()->route($this->redirects[Auth::guard('admin')->user()->perfil]);
    }
}
