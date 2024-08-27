<?php

namespace App\Support;

use Exception;

class ExceptionTreatment
{
    private $code;
    private $entity;
    private $notification;
    private $exception;

    public function __construct(Exception $exception, $entity)
    {
        $this->entity = $entity;
        $this->exception = $exception;
    }

    public function getMessage()
    {
        dd($this->exception);
        switch ($this->exception->getCode()) {
            case '0':
                $this->notification = array(
                    'message' => 'Registro não encontrado na base de dados',
                    'alert-type' => 'error'
                );
                break;
            case '23000':
                $this->notification = array(
                    'message' => $this->entity.' já existe',
                    'alert-type' => 'error'
                );
                break;
            case '22001':
                $this->notification = array(
                    'message' => 'Texto muito longo para um dos campo na entidade '.$this->entity,
                    'alert-type' => 'error'
                );
                break;
            default:
                $this->notification = array(
                    'message' => 'Error desconhecido. Detalhes: <Br>'. $this->exception,
                    'alert-type' => 'error'
                );
                break;
        }

        return $this->notification;
    }
}
