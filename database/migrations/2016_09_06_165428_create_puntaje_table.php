<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntajes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('competencia_id')->unsigned();
            $table->integer('puesto');
            $table->float('puntos');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntajes');
    }
}
