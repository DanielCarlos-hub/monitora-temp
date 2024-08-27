<?php

namespace App\Http\Controllers\Dashboard\Monitoramento;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Tenant\Equipamento;
use App\Models\Tenant\Log;
use App\Models\Tenant\Temperatura;
use App\Models\Tenant\TipoEquipamento;
use App\Util\TenantConnector;
use Illuminate\Http\Request;

class ClienteEquipamentosController extends Controller
{

    public function index(Request $request, $cliente)
    {

        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);

        if($request->ajax()){

            $equipamentos = Equipamento::with('tipo', 'temperaturas', 'temperaturaAtual')->get();

            foreach($equipamentos as $equipamento){
                $array[] = [
                    'id' => $equipamento->id,
                    'num_placa' => $equipamento->num_placa,
                    'nome_equipamento' => $equipamento->nome_equipamento,
                    'tipo' => $equipamento->tipo->tipo,
                    'temperatura_min' => $equipamento->temperaturas->min('temperatura'),
                    'temperatura_max' => $equipamento->temperaturas->max('temperatura'),
                    'temperatura_media' => number_format( (float) $equipamento->temperaturas->avg('temperatura'), 2, '.', ''),
                    'temperatura_atual' => $equipamento->temperaturaAtual->temperatura,
                ];
            }

            return datatables()->of($array)->make(true);
        }

        return view('dashboard.monitoramento.clientes.equipamentos.index', compact('tenant'));
    }

    public function create($cliente){

        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);
        $tipos = TipoEquipamento::all();

        return view('dashboard.monitoramento.clientes.equipamentos.create', compact('tenant', 'tipos'));

    }

    public function store(Request $request, $cliente)
    {

        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);

        try {
            $equipamento = $request->all();
            Equipamento::create($equipamento);

            $notification = array(
                'message' => 'Novo equipamento cadastrado',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.monitoramento.clientes.show', $cliente)->with($notification);

        } catch( \Illuminate\Database\QueryException $q){

            $errorCode = $q->errorInfo[1];

            if($errorCode == 1062){
                $notification = array(
                    'message' => 'Esse número de placa já está cadastrado para outro equipamento',
                    'alert-type' => 'error'
                );

            }

            return redirect()->back()->withInput($request->all())->with($notification);

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Houve um erro ao cadastrar o equipamento do cliente',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput($request->all())->with($notification);
        }
    }

    public function show($cliente, $id)
    {
        try {
            $tenant = Tenant::findOrFail($cliente);
            TenantConnector::connect($tenant);

            $equipamento = Equipamento::with(['temperaturas' => function($query){
                $query->orderBy('created_at', 'desc');
            },'temperaturaAtual'])->findOrFail($id);
            $tipos = TipoEquipamento::all();

            return view('dashboard.monitoramento.clientes.equipamentos.temperaturas', compact('tenant', 'equipamento', 'tipos'));

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Error ao localizar o equipamento no banco de dados',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function edit($cliente, $id)
    {
        try {
            $tenant = Tenant::findOrFail($cliente);
            TenantConnector::connect($tenant);

            $equipamento = Equipamento::findOrFail($id);
            $tipos = TipoEquipamento::all();

            return view('dashboard.monitoramento.clientes.equipamentos.edit', compact('tenant', 'equipamento', 'tipos'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            $notification = array(
                'message' => 'Error ao localizar o equipamento no banco de dados',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {

            dd($e);
            $notification = array(
                'message' => 'Erro desconhecido',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $cliente, $id)
    {
        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);

        try {
            $equipArray = $request->all();

            $equipamento = Equipamento::findOrFail($id);
            $equipamento->update($equipArray);

            $notification = array(
                'message' => 'O Equipamento '. $equipamento->nome_equipamento. '('.$equipamento->num_placa. ')'. ' foi atualizado',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.monitoramento.clientes.show', $cliente)->with($notification);

        } catch( \Illuminate\Database\QueryException $q){

            $errorCode = $q->errorInfo[1];

            if($errorCode == 1062){
                $notification = array(
                    'message' => 'Esse número de placa já está cadastrado para outro equipamento',
                    'alert-type' => 'error'
                );

            }

            return redirect()->back()->withInput($request->all())->with($notification);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            $notification = array(
                'message' => 'Equipamento não localizado',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput($request->all())->with($notification);

        } catch (\Exception $e) {

            dd($e);
            $notification = array(
                'message' => 'Erro desconhecido ao atualizar o equipamento',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput($request->all())->with($notification);
        }
    }

    public function getEquipamentoJson($cliente, $equipamento){
        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);

        try {
            $equipamento = Equipamento::findOrFail($equipamento);

            return response()->json($equipamento, 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {

            return response('Erro! Equipamento não encontrado', 404);

        } catch (\Exception $e) {

            return response('Não foi possível completar a solicitação', 400);
        }
    }

    public function getEquipamentoTemp($cliente, $equipamento){

        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);

        $temperatura = Equipamento::with('temperaturas','temperaturaAtual')->findOrFail($equipamento);

        $temperaturas = [
            'atual' => $temperatura->temperaturaAtual->temperatura,
            'max' => $temperatura->temperaturas->max('temperatura'),
            'min' => $temperatura->temperaturas->min('temperatura'),
            'avg' => number_format( (float) $temperatura->temperaturas->avg('temperatura'), 2, '.', ''),
        ];

        return response()->json($temperaturas);
    }

    public function notifications($cliente, $equipamento){

        try {
            $tenant = Tenant::findOrFail($cliente);
            TenantConnector::connect($tenant);

            $equipamento = Equipamento::with('notifications')->findOrFail($equipamento);

            return view('dashboard.monitoramento.clientes.equipamentos.notifications', compact('tenant', 'equipamento'));

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Error ao localizar o equipamento no banco de dados',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function logs($cliente, $equipamento){

        try {
            $tenant = Tenant::findOrFail($cliente);
            TenantConnector::connect($tenant);

            $equipamento = Equipamento::with('logs')->findOrFail($equipamento);

            return view('dashboard.monitoramento.clientes.equipamentos.logs', compact('tenant', 'equipamento'));

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Error ao localizar o equipamento no banco de dados',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function visualizarLog($cliente, $equipamento, $log){

        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);
        try {

            $equipamento = Equipamento::with('logs')->findOrFail($equipamento);

            $log = Log::with('backend')->whereHas('backend')->findOrFail($log);

            return view('dashboard.monitoramento.clientes.equipamentos.visualizarLog', compact('tenant', 'equipamento', 'log'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            $notification = array(
                'message' => 'Não foram localizados mais detalhes para esse log',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {

            dd($e);
            $notification = array(
                'message' => 'Erro desconhecido ao carregar o log do equipamento',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function clearTemperaturas($cliente, $equipamento){
        $tenant = Tenant::findOrFail($cliente);
        TenantConnector::connect($tenant);

        try {
            $equipamento = Equipamento::with('temperaturas')->findOrFail($equipamento);

            $equipamento->temperaturas()->delete();

            return response('Temperaturas do equipamento '. $equipamento->nome_equipamento. ' ('.$equipamento->num_placa.') foram apagadas', 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {

            return response('Erro! Equipamento não encontrado', 404);
        } catch (\Exception $e) {
            dd($e);
            return response('Não foi possível completar a solicitação', 400);
        }
    }
}
