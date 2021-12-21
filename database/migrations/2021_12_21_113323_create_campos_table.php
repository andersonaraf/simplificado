<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collapse_id');
            $table->unsignedBigInteger('atributo_id')->nullable();

            $table->string('nome')->comment('NOME DO LABEL QUE ESTÁ REFERENCIANDO O CAMPO.');
            $table->boolean('pontuar')->default('0')->comment('VERIFICAR SE O CAMPO VAI REALIZAR PONTUAÇÃO.');
            $table->float('ponto')->comment('PONTUAÇÃO MAXIMA DO CAMPO.')->nullable();
            $table->timestamps();

            $table->foreign('collapse_id')->references('id')->on('collapses');
            $table->foreign('atributo_id')->references('id')->on('atributos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campos');
    }
}
