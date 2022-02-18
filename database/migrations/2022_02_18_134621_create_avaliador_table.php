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
            $table->unsignedBigInteger('candidato');

            $table->foreign('avaliador')->references('id')->on('users');
            $table->foreign('candidato')->references('id')->on('users');
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
