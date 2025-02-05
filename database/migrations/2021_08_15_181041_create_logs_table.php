<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipamento_id');
            $table->longText('message');
            $table->timestamps();

            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
