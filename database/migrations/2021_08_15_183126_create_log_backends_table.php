<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogBackendsTable extends Migration
{

    public function up()
    {
        Schema::create('log_backend', function (Blueprint $table) {
            $table->unsignedBigInteger('log_id');
            $table->longText('error_message');
            $table->longText('error_trace');
            $table->char('error_code');
            $table->string('error_file', 255);
            $table->char('error_line', 20);
            $table->char('error_class', 50);

            $table->primary('log_id');
            $table->foreign('log_id')->references('id')->on('logs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_backend');
    }
}
