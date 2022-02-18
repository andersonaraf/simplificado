<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvaliadoRevisadoToFormularioUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulario_usuario', function (Blueprint $table) {
            //
            $table->boolean('avaliado')->nullable()->comment('COLUNA PARA SABER SE O CANDIDATO FOI APROVADO OU REPROVADO AMBAS COLUNAS DEVEM TER 1 PARA APROVADO E 0 PARA REPROVADO!')->after('user_id_is_assessing');
            $table->boolean('revisado')->nullable()->comment('COLUNA PARA SABER SE O CANDIDATO FOI APROVADO OU REPROVADO AMBAS COLUNAS DEVEM TER 1 PARA APROVADO E 0 PARA REPROVADO!')->after('avaliado');
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
            $table->dropColumn('avaliado');
            $table->dropColumn('revisado');
        });
    }
}
