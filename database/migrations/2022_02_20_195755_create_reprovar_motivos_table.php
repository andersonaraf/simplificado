<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReprovarMotivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reprovar_motivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ID DO USUÁRIO QUE REPROVOU');
            $table->unsignedBigInteger('formulario_usuario_id')->comment('ID DO USUÁRIO QUE FOI REPROVADO');
            $table->string('motivo', 500);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('reprovar_motivos');
    }
}
