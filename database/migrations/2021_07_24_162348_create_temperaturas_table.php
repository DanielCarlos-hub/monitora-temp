<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemperaturasTable extends Migration
{

    public function up()
    {
        Schema::create('temperaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipamento_id');
            $table->decimal('temperatura', 10, 2);
            $table->boolean('notificado')->default(0);
            $table->timestamps();

            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('temperaturas');
    }
}
