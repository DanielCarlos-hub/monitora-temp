<?php

namespace App\Http\Controllers\Dashboard\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Tenant\Cliente;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteConfigController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function clienteConfig()
    {
        $cliente = Cliente::firstOrFail();

        return view('dashboard.cliente.config', compact('cliente'));
    }

    public function updateClienteConfig(Request $request, $tenant, $id)
    {

        try {
            $cliente = Cliente::findOrFail($id);
            $adminTenant = Tenant::findOrFail($tenant);

            $clienteConfig = $request->cliente;

            if($request->hasFile('logo')){
                $filenameWithExt = $request->file('logo')->getClientOriginalName();
                $extension = $request->file('logo')->getClientOriginalExtension();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                if($this->resizeImage($request->file('logo'), 512, $tenant, 'logo', $fileNameToStore)){
                    $clienteConfig['logo'] = $tenant.'/logo/'.$fileNameToStore;
                }
            }

            if($request->hasFile('favicon')){
                $filenameWithExt = $request->file('favicon')->getClientOriginalName();
                $extension = $request->file('favicon')->getClientOriginalExtension();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                if($this->resizeImage($request->file('favicon'), 32, $tenant, 'favicon', $fileNameToStore)){
                    $clienteConfig['favicon'] = $tenant.'/favicon/'.$fileNameToStore;
                }
            }

            $cliente->update($clienteConfig);

            $adminTenant->update([
                'fantasia' => $clienteConfig['fantasia'],
                'fonesms1' => $clienteConfig['fonesms1'],
                'fonesms2' => $clienteConfig['fonesms2'],
            ]);

            $notification = array(
                'message' => 'As configurações do cliente foram atualizadas',
                'alert-type' => 'success'
            );
            return back()->with($notification);

        } catch (\Exception $e) {
            dd($e);
            $notification = array(
                'message' => 'Não foi possível atualizar as configurações do Cliente',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function resizeImage($file, $resolution, $tenant, $folder, $fileNameToStore) {
        // Resize image
        $resize = Image::make($file)->resize($resolution, null, function ($constraint) {
          $constraint->aspectRatio();
        })->encode('jpg');

        $hash = md5($resize->__toString());

        $bool = Storage::disk('clientes')->put("{$tenant}/{$folder}/{$fileNameToStore}", $resize->__toString());

        return $bool;
      }
}
