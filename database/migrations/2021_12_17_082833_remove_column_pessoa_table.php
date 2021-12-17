<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnPessoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoa', function (Blueprint $table) {
            //
            $table->dropForeign('pessoa_cargo_id_foreign');
            $table->dropForeign('pessoa_comprovante_id_foreign');
            $table->dropForeign('pessoa_edital_dinamico_id_foreign');
            $table->dropForeign('pessoa_escolaridade_id_foreign');
            $table->dropColumn(['cargo_id']);
            $table->dropColumn(['escolaridade_id']);
            $table->dropColumn(['comprovante_id']);
            $table->dropColumn(['edital_dinamico_id']);
            $table->dropColumn(['status']);
            $table->dropColumn(['status_avaliado']);
            $table->dropColumn(['status_revisado']);
            $table->dropColumn(['status_pericia_pne']);
            $table->dropColumn(['motivo_rev']);
            $table->dropColumn(['check_cadastro_anexo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pessoa', function (Blueprint $table) {
            //
        });
    }
}
