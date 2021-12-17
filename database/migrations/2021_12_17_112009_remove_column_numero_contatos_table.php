<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnNumeroContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('numero_contatos', function (Blueprint $table) {
            //
            $table->dropColumn(['DDI']);
            $table->dropColumn(['ddd']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('numero_contatos', function (Blueprint $table) {
            //
        });
    }
}
