<?php

namespace App\Freezolar\Cliente;

use App\Models\Tenant\Cliente;

class ClienteConfig
{
    private $logo;
    private $favicon;
    private $nome;

    public function __construct()
    {
        $cliente = Cliente::firstOrFail();

        $this->logo = $cliente->logo;
        $this->favicon = $cliente->favicon;
        $this->nome = $cliente->fantasia;
    }

    public function logo()
    {
        return $this->logo;
    }

    public function favicon()
    {
        return $this->favicon;
    }

    public function nome()
    {
        return $this->nome;
    }

}
