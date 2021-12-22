<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('attr_id')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('value')->nullable();
            $table->string('title')->nullable();
            $table->float('max')->nullable();
            $table->float('min')->nullable();
            $table->float('steep')->nullable();
            $table->boolean('required')->nullable();
            $table->boolean('selected')->nullable();
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
        Schema::dropIfExists('atributos');
    }
}
