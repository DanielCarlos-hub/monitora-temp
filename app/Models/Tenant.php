<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $connection = 'main';

    public $incrementing = false;

    protected $fillable = [
        'id', 'fantasia', 'cnpj', 'fonesms1', 'fonesms2', 'fonesms3', 'email', 'nome', 'db_host', 'db_port', 'db_name', 'db_username', 'db_password'
    ];

    public function users(){
        return $this->hasMany(User::class, "tenant", "id");
    }
}
