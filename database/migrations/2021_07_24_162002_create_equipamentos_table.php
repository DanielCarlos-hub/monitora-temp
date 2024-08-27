<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipamentosTable extends Migration
{

    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->char('num_placa')->unique();
            $table->string('nome_equipamento');
            $table->decimal('temperatura_max', 10, 2);
            $table->decimal('temperatura_min', 10, 2);
            $table->decimal('temperatura_crit_min', 10, 2);
            $table->decimal('temperatura_crit_max', 10, 2);
            $table->timestamps();

            $table->unsignedBigInteger('tipo_id')->references('id')->on('tipo_equipamento');
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipamentos');
    }
}
