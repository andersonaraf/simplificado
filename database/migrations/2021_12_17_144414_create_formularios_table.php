<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->comment('NOME DO FORMULÁRIO');
            $table->string('pontuacao')->comment('PONTUAÇÃO MÁXIMA QUE O CANDIDATO PODE ATINGIR');
            $table->boolean('liberado')->default(0)->comment('SE O FORMULÁRIO ESTÁ ATIVO OU NÃO PARA NOVAS CANDIDATURAS. 1 - ATIVO | 0 - DESATIVADO');
            $table->dateTime('data_liberar')->comment('DATA QUE O FORMULÁRIO VAI ABRIR')->nullable();
            $table->dateTime('data_fecha')->comment('DATA QUE O FORMULÁRIO VAI FECHAR')->nullable();
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
        Schema::dropIfExists('formularios');
    }
}
