<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTipoCampoIdCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('tipo_campo_id');
            $table->foreign('tipo_campo_id')->references('id')->on('tipo_campos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campos', function (Blueprint $table) {
            //
        });
    }
}
