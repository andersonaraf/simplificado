<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPontuacaoTotalToFormularioUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulario_usuario', function (Blueprint $table) {
            $table->integer('pontuacao_total')->comment('pontuação total da pessoa no formulario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulario_usuario', function (Blueprint $table) {
            //
        });
    }
}
