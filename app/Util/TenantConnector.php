<?php

namespace App\Util;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Tenant;

class TenantConnector
{
    public static function connect(Tenant $tenant)
    {
        DB::purge('tenant');
        $config = Config::get('database.connections.main');
        $config['host'] = $tenant->db_host;
        $config['port'] = $tenant->db_port;
        $config['database'] = $tenant->db_name;
        $config['username'] = $tenant->db_username;
        $config['password'] = $tenant->db_password != '' && !is_null($tenant->db_password) ? Crypt::decrypt($tenant->db_password) : '';
        Config::set("database.connections.tenant", $config);

    }
}
