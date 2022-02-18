<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdIsEditingToFormularioUsuarioTable extends Migration
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
            $table->dateTime('lock')->nullable()->after('cargo_id');
            $table->unsignedBigInteger('user_id_is_assessing')->after('cargo_id')->nullable()->comment('ESSA COLUNA MOSTRA QUAL É O USUÁRIO QUE ESTÁ AVALIADANDO O FORMULÁRIO DO CANDIDATO.');
            $table->foreign('user_id_is_assessing')->references('id')->on('users');
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
            $table->dropForeign(['user_id_is_assessing']);
            $table->dropColumn('user_id_is_assessing');
        });
    }
}
