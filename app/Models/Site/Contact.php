<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contatos';

    protected $fillable = [
        'nome',
        'email',
        'cep',
        'cidade',
        'estado',
        'telefone',
        'celular',
        'whatsapp',
        'mensagem',
    ];
}
