<?php

namespace App\Http\Controllers\Dashboard\Monitoramento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('dashboard.monitoramento.home');
    }
}
