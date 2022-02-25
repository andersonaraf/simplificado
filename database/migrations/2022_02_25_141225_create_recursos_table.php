<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_usuario_id')->comment('ID DO FORMULÁRIO DO USUÁRIO QUE SOLICITOU O RECURSO');
            $table->unsignedBigInteger('aprovou_recurso')->nullable()->comment('ID DE QUEM APROVOU O RECURSO');
            $table->string('texto', 1000);
            $table->float('pontuacao', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('formulario_usuario_id')->references('id')->on('formulario_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recursos');
    }
}
