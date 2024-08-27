<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use App\Util\TenantConnector;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            if($guard == "admin"){
                return redirect()->route('dashboard.admin.home');
            }else{
                switch (Auth::guard('web')->user()->perfil) {

                    case 'cliente':
                        return redirect()->route('cliente.home', $request->tenant);
                        break;

                    default:
                        return redirect()->route('auth.cliente.login', $request->tenant);
                }
            }
        }

        return $next($request);
    }
}
