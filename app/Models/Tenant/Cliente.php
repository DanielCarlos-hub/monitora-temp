<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'tenant';

    protected $fillable = [
        'fantasia', 'cep', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'fonesms1', 'fonesms2', 'fonesms3', 'email', 'active', 'logo', 'favicon',
    ];
}
