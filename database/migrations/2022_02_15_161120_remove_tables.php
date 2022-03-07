<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('telas_edital');
        Schema::dropIfExists('tipo_telas');
        Schema::dropIfExists('edital_dinamico_tipo_anexos');
        Schema::dropIfExists('escolaridade_edital_dinamicos');
        Schema::dropIfExists('progress');
        Schema::dropIfExists('documento_dinamicos');
        Schema::dropIfExists('edital_dinamicos');
        Schema::dropIfExists('pontuacao_edital');
        Schema::dropIfExists('pessoa_edital_anexos');
        Schema::dropIfExists('tipo_anexo_cargos');
        Schema::dropIfExists('pontuacoes');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
