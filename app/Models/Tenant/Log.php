<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $connection = 'tenant';
    protected $table = 'logs';

    protected $fillable = [
        'equipamento_id', 'message'
    ];

    public function equipamento(){
        return $this->belongsTo(Equipamento::class);
    }

    public function backend(){
        return $this->hasOne(LogBackend::class, 'log_id', 'id');
    }

    public function frontend(){
        return $this->hasOne(LogFrontend::class, 'log_id', 'id');
    }
}
