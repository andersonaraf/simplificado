<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveReprovarPessoasToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       //DROP TABLE
       Schema::dropIfExists('reprovar_pessoas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reprovar_pessoas', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedBigInteger('pessoa_id');
            $table->unsignedBigInteger('avaliador_id');
            $table->string('motivo');
            $table->timestamps();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->foreign('avaliador_id')->references('id')->on('users');
        });
    }
}
