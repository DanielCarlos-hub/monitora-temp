<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Temperatura extends Model
{
    protected $connection = 'tenant';

    protected $fillable = [
        'equipamento_id', 'temperatura', 'notificado'
    ];

    public function equipamento(){
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }
}
