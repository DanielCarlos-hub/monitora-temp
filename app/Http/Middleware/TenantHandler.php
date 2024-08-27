<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Util\TenantConnector;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class TenantHandler
{
    public function handle(Request $request, Closure $next)
    {

        try {
            $tenant = Tenant::findOrFail($request->tenant);
            TenantConnector::connect($tenant);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return Redirect::to(Config::get('app.url'));
        }


        return $next($request);
    }
}
