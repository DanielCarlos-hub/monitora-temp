<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
   protected $table = 'site_config';
   protected $fillable = [
       'logo', 'favicon', 'nome', 'descricao', 'facebook', 'instagram', 'twitter', 'pinterest', 'linkedin', 'endereco', 'telefone', 'celular', 'email', 'whatsapp'
   ];

   public $timestamps = false;
}
