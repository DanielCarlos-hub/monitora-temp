<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Tenant\Cliente;
use App\Models\Tenant\Equipamento;
use App\Models\Tenant\TipoEquipamento;
use App\Models\Tenant\User;
use App\Util\CreateDatabase;
use App\Util\TenantConnector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $clientes = Tenant::all();

            return datatables()->of($clientes)->make(true);
        }

        return view('dashboard.admin.clientes.index');
    }

    public function create()
    {
        return view('dashboard.admin.clientes.create');
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $tenant = Tenant::create([
                'id' => $request->nome,
                'fantasia' => $request->fantasia,
                'cnpj' => $request->cnpj,
                'email' => $request->email,
                'fonesms1' => $request->fonesms1,
                'fonesms2' => $request->fonesms2,
                'fonesms3' => $request->fonesms3,
                'nome' => $request->nome,
                'db_host' => $request->db_host,
                'db_port' => $request->db_port,
                'db_name' => 'freezola_'.$request->db_name,
                'db_username' => 'freezola_'.$request->db_username,
                'db_password' => Crypt::encrypt($request->db_password),
            ]);

            $tenant->users()->create([
                'username' => $request->nome,
                'nome' => $request->fantasia,
                'email' => $request->email,
                'password' => 'freezolar',
                'perfil' => 'cliente',
                'active' => 1,
            ]);

            $db = CreateDatabase::create($tenant);

            if($db['status']){
                DB::commit();
                TenantConnector::connect($tenant);

                Artisan::call('migrate', ['--database' => 'tenant']);

                Cliente::create([
                    'fantasia' => $request->fantasia,
                    'cep' => $request->cep,
                    'endereco' => $request->endereco,
                    'numero' => $request->numero,
                    'complemento' => $request->complemento,
                    'bairro' => $request->bairro,
                    'cidade' => $request->cidade,
                    'estado' => $request->estado,
                    'fonesms1' => $request->fonesms1,
                    'fonesms2' => $request->fonesms2,
                    'fonesms3' => $request->fonesms3,
                    'email' => $request->email,
                    'active' => 1
                ]);

                User::create([
                    'username' => $request->nome,
                    'nome' => $request->fantasia,
                    'email' => $request->email,
                    'password' => 'freezolar',
                    'active' => 1,
                ]);

                Config::set('database.connections.main');

                $notification = array(
                    'message' => 'Novo cliente cadastrado',
                    'alert-type' => 'success'
                );

                return redirect()->route('dashboard.admin.clientes.index')->with($notification);

            }else{

                DB::rollBack();
                $notification = array(
                    'message' => 'Houve um erro ao cadastrar o banco de dados, '.$db['message'],
                    'alert-type' => 'error'
                );

                return redirect()->back()->withInput($request->all())->with($notification);
            }


        } catch (\Exception $e) {
            DB::rollBack();
            $notification = array(
                'message' => 'Error ao cadastrar o cliente',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput($request->all())->with($notification);
        }
    }

    public function show($id)
    {
        try {
            $tenant = Tenant::findOrFail($id);
            TenantConnector::connect($tenant);

            $equipamentos = Equipamento::with('tipo', 'temperaturas', 'temperaturaAtual')->get();

            $tipos = TipoEquipamento::all();
            $countEquipamentos = Equipamento::all()->count();

            return view('dashboard.admin.clientes.clienteEquipamentos', compact('tenant', 'equipamentos', 'countEquipamentos', 'tipos'));

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Error ao localizar o cliente no banco de dados',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function edit($id)
    {
        try {
            $tenant = Tenant::findOrFail($id);

            return view('dashboard.admin.clientes.edit', compact('tenant'));

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Error ao localizar o cliente no banco de dados',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $tenant = Tenant::findOrFail($id);
            TenantConnector::connect($tenant);

            $tenant->update([
                'fonesms1' => $request->fonesms1,
                'fonesms2' => $request->fonesms2,
                'fonesms3' => $request->fonesms3,
                'fantasia' => $request->fantasia,
                'cnpj' => $request->cnpj,
                'email' => $request->email,
                'active' => $request->status_financeiro
            ]);

            $cliente = Cliente::firstOrFail();

            $cliente->update([
                'fonesms1' => $request->fonesms1,
                'fonesms2' => $request->fonesms2,
                'fonesms3' => $request->fonesms3,
                'fantasia' => $request->fantasia,
                'email' => $request->email,
            ]);

            $notification = array(
                'message' => 'O cliente foi atualizado',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.admin.clientes.index')->with($notification);

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Ocorreu um erro ao atualizar o cliente',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput($request->all())->with($notification);
        }
    }
}
