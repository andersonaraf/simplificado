<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInformativoToCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargos', function (Blueprint $table) {
            //
            $table->string('informativo', 1000)->after('cargo')->nullable()->comment('CAMPO PARA ADICIONAR UMA DESCRIÇÃO OU INFORMAÇÃO PARA O CARGO AO PARTICIPANTE.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cargos', function (Blueprint $table) {
            //
            $table->dropColumn('informativo');
        });
    }
}
