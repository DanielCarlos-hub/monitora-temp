<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBackend extends Model
{
    protected $connection = 'tenant';
    protected $table = 'log_backend';

    protected $primaryKey = 'log_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'log_id', 'error_message', 'error_trace', 'error_code', 'error_file', 'error_line', 'error_class'
    ];

    public function log(){
        return $this->belongsTo(Log::class);
    }
}
