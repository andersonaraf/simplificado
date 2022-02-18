<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontuacaoCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontuacao_campos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_usuario_campos_id')->comment('CAMPO DO CANDIDATO QUE ESTÁ SENDO PONTUADO');
            $table->unsignedBigInteger('user_id')->comment('USUÁRIO QUE ESTÁ PONTUANDO');
            $table->float('pontuacao', 8,2)->comment('PONTUAÇÃO DO CAMPO DO USUÁRIO');
            $table->timestamps();

            $table->foreign('formulario_usuario_campos_id')->references('id')->on('formulario_usuario_campos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pontuacao_campos');
    }
}
