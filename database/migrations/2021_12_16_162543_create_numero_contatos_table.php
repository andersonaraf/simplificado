<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumeroContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numero_contatos', function (Blueprint $table) {
            $table->id();
            $table->string('DDI', 10)->nullable();
            $table->string('ddd', 10);
            $table->string('numero', 20);
            $table->unsignedBigInteger('pessoa_id');
            $table->timestamps();

            $table->foreign('pessoa_id')->references('id')->on('pessoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('numero_contatos');
    }
}
