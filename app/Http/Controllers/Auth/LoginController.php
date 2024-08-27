<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cliente;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo;

    protected $username;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function showLoginForm(){

        $cliente = Cliente::firstOrFail();
        return view('auth.logincliente', compact('cliente'));
    }

    public function redirectTo()
    {
        switch (Auth::user()->perfil) {

            case 'cliente':
                $this->redirectTo = route('cliente.home', request()->tenant);
                return $this->redirectTo;
                break;

            default:
            return redirect()->route('auth.cliente.login', request()->tenant);
        }

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
        Auth::guard('web')->logout();
        return redirect('/cliente/login');
    }
}
