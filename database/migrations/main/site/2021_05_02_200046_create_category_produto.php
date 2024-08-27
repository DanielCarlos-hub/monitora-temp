<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProduto extends Migration
{

    public function up()
    {
        Schema::create('category_produto', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('produto_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->primary(['category_id', 'produto_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_produto');
    }
}
