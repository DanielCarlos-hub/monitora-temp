<?php

namespace App\Services;

use App\Models\Tenant\Log;
use App\Models\Tenant;
use App\Models\Tenant\Equipamento;
use App\Models\Tenant\Notification;
use Carbon\Carbon;
use Twilio\Rest\Client;

class TwilioNotification{

    private $account_sid = "ACd9923f6ff81ef73d307a82ecb8fbc33a";
    private $auth_token = "4947996852b7f44c6afd51e585cc8db2";
    private $twilio_number = "+12085345799";

    private Equipamento $equipamento;
    private $temperatura;

    public function __construct(Equipamento $equipamento, $temperatura){

        $this->equipamento = $equipamento;
        $this->temperatura = $temperatura;
    }

    public function smsNotification($telefones){

        $message = "A temperatura crítica do equipamento ". $this->equipamento->nome_equipamento. " foi atingida. \n Temperatura do equipamento: ".$this->temperatura. "\n Data e hora: ". Carbon::now()->format('d/m/Y H:i:s');

        foreach($telefones as $telefone){
            try {

                $client = new Client($this->account_sid, $this->auth_token);
                $client->messages->create('+55'.$telefone, [
                    'from' => $this->twilio_number,
                    'body' => $message
                ]);

                Notification::create([
                    'equipamento_id' => $this->equipamento->id,
                    'servico' => 'Twilio SMS',
                    'telefone' => $telefone,
                    'mensagem' => $message,
                    'status' => 'Enviado',
                ]);

            } catch (\Exception $e) {

                Notification::create([
                    'equipamento_id' => $this->equipamento->id,
                    'servico' => 'Twilio SMS',
                    'telefone' => $telefone,
                    'mensagem' => $message,
                    'status' => 'Falhou',
                ]);

                $log = Log::create([
                    'equipamento_id' => $this->equipamento->id,
                    'message' => 'Error ao enviar a mensagem SMS para o número '. $telefone. ' confira outros campos para mensagens mais detalhadas.',
                ]);

                $log->backend()->create([
                    'error_message' => $e->getMessage(),
                    'error_trace' => $e->getTraceAsString(),
                    'error_code' => $e->getCode(),
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine(),
                    'error_class' => get_class($this),
                ]);
            }
        }
    }
}
