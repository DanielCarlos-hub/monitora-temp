<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $connection = 'tenant';
    protected $table = 'notifications';

    protected $fillable = [
        'equipamento_id', 'servico', 'telefone', 'mensagem', 'status'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function equipamento(){
        return $this->belongsTo(Equipamento::class);
    }
}
