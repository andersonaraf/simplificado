<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliador', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('avaliador');
            $table->unsignedBigInteger('formulario_usuario');

            $table->foreign('avaliador')->references('id')->on('users');
            $table->foreign('formulario_usuario')->references('id')->on('formulario_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliador');
    }
}
