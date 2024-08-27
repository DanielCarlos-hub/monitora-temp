<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Tenant\Equipamento;
use App\Models\Tenant\Temperatura;
use App\Services\TwilioNotification;
use App\Services\BulkSMS;
use App\Services\SMSDev;
use App\Util\TenantConnector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemperaturaController extends Controller
{
    public function enviar(Request $request){

        $tenant = Tenant::findOrFail($request->cliente);
        TenantConnector::connect($tenant);

        try {

            $equipamento = Equipamento::where('num_placa', '=', $request->equipamento)->first();

            if($request->temperatura < $equipamento->temperatura_crit_max ||
                $request->temperatura > $equipamento->temperatura_crit_min){

                $fonenumbers = [
                    'fonesms1' => $tenant->fonesms1,
                    'fonesms2' => $tenant->fonesms2,
                    'fonesms3' => $tenant->fonesms3,
                ];

                $notificado = 1;
                //(new SMSDev($equipamento, $request->temperatura))->smsNotification($fonenumbers);
                (new TwilioNotification($equipamento, $request->temperatura))->smsNotification(array_filter($fonenumbers));
                //(new BulkSMS($equipamento, $request->temperatura))->smsNotification($tenant->fonecelular);
            }

            Temperatura::create([
                'equipamento_id' => $equipamento->id,
                'temperatura' => $request->temperatura,
                'notificado' => isset($notificado) ? $notificado : 0,
            ]);

            return response('Temperatura inserida com sucesso', 200);

        } catch (\Exception $e) {
            return response()->json(['mensagem' => $e->getMessage()], 400);
        }

    }


    public function retornarValor(){
        return response('mensagem', 200);
    }
}
