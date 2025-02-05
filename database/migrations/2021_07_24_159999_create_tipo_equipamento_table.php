<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoEquipamentoTable extends Migration
{

    public function up()
    {
        Schema::create('tipo_equipamento', function (Blueprint $table) {
            $table->id();
            $table->char('tipo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_equipamento');
    }
}
