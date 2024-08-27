<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'main';

    protected $guard = 'admin';

    protected $fillable = [
        'tenant',
        'nome',
        'username',
        'email',
        'perfil',
        'active',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class, 'tenant', 'id');
    }
}
