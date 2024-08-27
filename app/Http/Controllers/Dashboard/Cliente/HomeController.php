<?php

namespace App\Http\Controllers\Dashboard\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cliente;
use App\Models\Tenant\Equipamento;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $cliente =  Cliente::firstOrFail();
        $equipamentos = Equipamento::with('tipo', 'temperaturas', 'temperaturaAtual')->get();

        return view('dashboard.cliente.home', compact('cliente', 'equipamentos'));
    }

    public function getEquipamentoTemp($tenant, $equipamento){

        $temperatura = Equipamento::with('temperaturas','temperaturaAtual')->findOrFail($equipamento);

        $temperaturas = [
            'atual' => $temperatura->temperaturaAtual->temperatura,
            'max' => $temperatura->temperaturas->max('temperatura'),
            'min' => $temperatura->temperaturas->min('temperatura'),
            'avg' => number_format( (float) $temperatura->temperaturas->avg('temperatura'), 2, '.', ''),
        ];

        return response()->json($temperaturas);
    }

    public function showEquipamento($tenant, $equipamento){

        try {
            $cliente =  Cliente::firstOrFail();
            $equipamento = Equipamento::with(['temperaturas' => function($query){
                $query->orderBy('created_at', 'desc');
            },'temperaturaAtual'])->findOrFail($equipamento);

            return view('dashboard.cliente.equipamento', compact('cliente', 'equipamento'));

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Error ao localizar o equipamento no banco de dados',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
