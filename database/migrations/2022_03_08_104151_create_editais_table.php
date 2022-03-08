<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_id');
            $table->string('titulo', 200);
            $table->string('documento')->nullable();
            $table->string('descricao', 1000)->nullable();
            $table->integer('hierarquia')->nullable();
            $table->timestamps();

            $table->foreign('formulario_id')->references('id')->on('formularios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editais');
    }
}
