<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoDinamicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_dinamicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edital_dinamico_tipo_anexo_id');
            $table->string('nome_documento');
            $table->boolean('obrigatorio')->default(false);
            $table->float('pontuacao_maxima')->nullable();
            $table->float('pontuacao_por_item')->nullable();
            $table->integer('quantidade_anexos')->nullable();
            $table->float('pontuacao_por_ano')->nullable();
            $table->float('pontuacao_por_mes')->nullable();
            $table->boolean('tipo_experiencia')->nullable();;
            $table->boolean( 'pontuacao_manual')->nullable();;

            $table->foreign('edital_dinamico_tipo_anexo_id')->references('id')->on('edital_dinamico_tipo_anexos');
            $table->boolean('especial')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_dinamicos');
    }
}
