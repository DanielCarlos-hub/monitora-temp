<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{

    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipamento_id');
            $table->char('servico', 30);
            $table->char('telefone', 20);
            $table->longText('mensagem');
            $table->char('status', 20);
            $table->timestamps();

            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
