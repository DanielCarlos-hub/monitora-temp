<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{

    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('fantasia')->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('endereco', 150)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('estado', 2)->nullable();
            $table->char('fonesms1', 20)->nullable();
            $table->char('fonesms2', 20)->nullable();
            $table->char('fonesms3', 20)->nullable();
            $table->string('email', 150)->unique()->nullable();
            $table->boolean('active')->default(1);
            $table->string('logo', 255)->default(NULL)->nullable();
            $table->string('favicon', 255)->default(NULL)->nullable();
            $table->boolean('disparar_email');
            $table->boolean('disparar_whatsapp');
            $table->boolean('disparar_sms');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
