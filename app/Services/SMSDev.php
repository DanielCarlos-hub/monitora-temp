<?php

namespace App\Services;

use App\Models\Tenant\Equipamento;
use App\Models\Tenant\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SMSDev{

    private $key = '9J75HHQA5FCVECYQMH1WKBILYW42O9KB2ZH1WIHN0EVOMVQLO5Q4W0B7FC75RBL7FUXAVGENVWL6686M2V7K9WIHBP7NT3VG9SYHB59K2BA39ITH7EQ174PQK4XPJA35';

    private Equipamento $equipamento;
    private $temperatura;

    public function __construct(Equipamento $equipamento, $temperatura){

        $this->equipamento = $equipamento;
        $this->temperatura = $temperatura;
    }

    public function smsNotification($telefones){

        $date = Carbon::now()->format('d/m/y H:i');

        foreach($telefones as $telefone){
            $payload = [
                "key" => $this->key,
                "type" => 9,
                "number" => '55'.$telefone,
                "msg" => "A temperatura crítica do equipamento ". $this->equipamento->nome_equipamento. " foi atingida. Temperatura do equipamento: ".$this->temperatura. " Data e hora: ". Carbon::now()->format('d/m/Y H:i:s'),
            ];

            try {

                Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->send('POST', 'https://api.smsdev.com.br/v1/send', [
                    "body" => json_encode($payload)
                ]);

                Notification::create([
                    'equipamento_id' => $this->equipamento->id,
                    'servico' => 'SMS Dev',
                    'telefone' => $telefone,
                    'mensagem' => $payload['msg'],
                    'status' => 'Enviado',
                ]);

            } catch (\Exception $e) {

                Notification::create([
                    'equipamento_id' => $this->equipamento->id,
                    'servico' => 'SMS Dev',
                    'telefone' => $telefone,
                    'mensagem' => $payload['msg'],
                    'status' => 'Falhou',
                ]);

            }
        }
    }
}
