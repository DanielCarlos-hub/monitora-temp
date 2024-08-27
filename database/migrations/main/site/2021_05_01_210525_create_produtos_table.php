<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->char('codigo', 20)->unique()->nullable();
            $table->string('nome', 255);
            $table->longText('descricao')->nullable();
            $table->char('modelo',55)->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->boolean('exibir')->default(1);
            $table->boolean('mostrar_preco')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
