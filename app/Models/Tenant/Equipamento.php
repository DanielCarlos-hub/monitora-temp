<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $connection = 'tenant';

    protected $fillable = [
        'tipo_id', 'num_placa', 'nome_equipamento', 'temperatura_max', 'temperatura_min', 'temperatura_crit_min', 'temperatura_crit_max',
    ];

    public function tipo(){
        return $this->belongsTo(TipoEquipamento::class, 'tipo_id', 'id');
    }

    public function temperaturas(){
        return $this->hasMany(Temperatura::class, 'equipamento_id', 'id');
    }

    public function temperaturaAtual(){
        return $this->hasOne(Temperatura::class, 'equipamento_id', 'id')->latest()->withDefault([
            'temperatura' => '0.00',
        ]);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function logs(){
        return $this->hasMany(Log::class);
    }
}
