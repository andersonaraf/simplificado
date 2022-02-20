<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBloquearToEscolaridade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escolaridade', function (Blueprint $table) {
            $table->boolean('bloquear')->comment('deixar cargo bloqueado com valor 1 e desbloqueado com o valor 0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escolaridade', function (Blueprint $table) {
            //
        });
    }
}
