<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormularioUsuarioCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulario_usuario_campos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_usuario_id');
            $table->unsignedBigInteger('campo_id');
            $table->string('valor', 250)->nullable()->comment('INFORMAÇÕES DO CAMPO');
            $table->string('observacao', 500)->nullable()->comment('CAMPO DE TEXTO PARA INSERIR INFORMAÇÕES, TAIS COMO MOTIVO DA REPROVAR OU DÚVIDA EM AVALIÇÃO/REVISÃO.');
            $table->timestamps();
            $table->foreign('formulario_usuario_id')->references('id')->on('formulario_usuario');
            $table->foreign('campo_id')->references('id')->on('campos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formulario_usuario_campos');
    }
}
