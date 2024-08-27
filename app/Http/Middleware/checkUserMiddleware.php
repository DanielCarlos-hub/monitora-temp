<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkUserMiddleware
{

    protected $redirects = [
        'cliente' => 'cliente.home',

    ];

    protected $route;

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('auth.cliente.login', $request->tenant);
        }

        $this->route = explode('.', $request->route()->getName());

        if(array_key_exists(Auth::user()->perfil, $this->redirects)){

            if(Auth::user()->perfil == $this->route[0]){
                return $next($request);
            }

        }

        return redirect()->route($this->redirects[Auth::user()->perfil]);
    }
}
