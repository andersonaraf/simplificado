<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFormularioUsuarioIdComprovante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comprovante', function (Blueprint $table) {
            $table->unsignedBigInteger('formulario_usuario_id');
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
        Schema::table('comprovante', function (Blueprint $table) {
            //
        });
    }
}
