<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigoUsadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_usados', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('codigo_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->integer('productora_id')->unsigned();
            $table->integer('competencia_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('codigo_id')->references('id')->on('codigos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');
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
        Schema::dropIfExists('codigo_usados');
    }
}
