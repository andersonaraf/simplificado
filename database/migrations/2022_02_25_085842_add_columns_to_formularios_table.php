<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formularios', function (Blueprint $table) {
            //
            $table->boolean('liberar_recurso')->default(0)->after('data_liberar')->comment('1 - PARA RECURSO LIBERADO 0 - PARA RECURSO NÃO LIBERADO.');
            $table->dateTime('data_liberar_recurso')->nullable()->after('liberar_recurso')->comment('DATA QUE RECURSO FOI LIBERADO.');
            $table->dateTime('data_fecha_recurso')->nullable()->after('data_liberar_recurso')->comment('DATA QUE RECURSO VAI FINALIZAR.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formularios', function (Blueprint $table) {
            //
        });
    }
}
