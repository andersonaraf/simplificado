<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAvaliacaoERevisaoToRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recursos', function (Blueprint $table) {
            //
            $table->boolean('status_avaliacao')->after('status')->nullable()->comment('CAMPO PARA VERIFICAR SE O RECURSO FOI AVALIADO, AMBOS PRECISAM ESTÁ EM CONCORDÂNCIA.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recursos', function (Blueprint $table) {
            //
            $table->dropColumn('status_avaliacao');
        });
    }
}
