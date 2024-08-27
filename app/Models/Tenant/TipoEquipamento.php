<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEquipamento extends Model
{
    protected $connection = 'tenant';

    protected $table = 'tipo_equipamento';

    protected $fillable = ['tipo'];

    public $timestamps = false;

    public function equipamentos(){
        return $this->hasMany(Equipamento::class, 'tipo_id', 'id');
    }
}
