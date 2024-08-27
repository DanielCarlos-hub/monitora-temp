<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Util\TenantConnector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

class AdminLoginController extends Controller
{

    protected $username;

    public function __construct() {
        $this->middleware('guest:admin', ['except' => ['logout']]);
        $this->username = $this->findUsername();
    }

    public function index() {
        return view('auth.loginprincipal');
    }

    public function login(Request $request) {

        $credentials = [ $this->username => $request->login,
        'password' => $request->password ];

        if(!is_null($request->cliente)){

            $tenant = Tenant::findOrFail($request->cliente);
            TenantConnector::connect($tenant);

            $authOk = Auth::guard('web')->attempt($credentials);

            if ($authOk) {
                return redirect()->route('cliente.home', $tenant->id);
            }
        }

        else{

            $authOk = Auth::guard('admin')->attempt($credentials);

            if ($authOk) {
                if(Auth::guard('admin')->user()->perfil == 'admin'){
                    return redirect('/admin/home')->with('status', 'Usuário Autenticado!');
                }
                else if(Auth::guard('admin')->user()->perfil == 'monitoramento'){
                    return redirect('/monitoramento/home')->with('status', 'Usuário Autenticado!');
                }
                else{
                    return redirect('/login')->with('erro', 'Usuário e/ou senha não conferem!');
                }
            }
        }

        return redirect('/login')->with('erro', 'Usuário e/ou senha não conferem!');
    }

    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
