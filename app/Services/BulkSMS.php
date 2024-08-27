<?php

namespace App\Services;

use App\Models\Tenant\Equipamento;
use App\Models\Tenant\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class BulkSMS{

    private $token;

    private Equipamento $equipamento;
    private $temperatura;

    public function __construct(Equipamento $equipamento, $temperatura){

        $this->equipamento = $equipamento;
        $this->temperatura = $temperatura;

        $this->token = Http::accept('application/json')->get('https://restapi.bulksmsonline.com/rest/api/v1/sms/gettoken/username/DaniSo397/password/dancarsoa551990')->json();
    }

    public function smsNotification($telefones){

        $date = Carbon::now()->format('d/m/y H:i');


        foreach($telefones as $telefone){
            $payload = [
                "from" => "Freezolar",
                "to" => [
                    '55'.$telefone,
                ],
                "type" => "text",
                "content" => "A temperatura crítica do equipamento ". $this->equipamento->nome_equipamento. " foi atingida. Temperatura do equipamento: ".$this->temperatura. " Data e hora: ". Carbon::now()->format('d/m/Y H:i:s'),
                "sendDateTime" => $date,
            ];

            try {

                Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'token' => $this->token["token"],
                ])->send('POST', 'https://restapi.bulksmsonline.com/rest/api/v1/sms/send', [
                    "body" => json_encode($payload)
                ]);


                Notification::create([
                    'equipamento_id' => $this->equipamento->id,
                    'servico' => 'BulkSMS',
                    'telefone' => $telefone,
                    'mensagem' => $payload['content'],
                    'status' => 'Enviado',
                ]);

            } catch (\Exception $e) {

                Notification::create([
                    'equipamento_id' => $this->equipamento->id,
                    'servico' => 'BulkSMS',
                    'telefone' => $telefone,
                    'mensagem' => $payload['content'],
                    'status' => 'Falhou',
                ]);
            }
        }
    }
}
