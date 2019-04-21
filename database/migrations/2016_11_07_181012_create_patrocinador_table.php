<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatrocinadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrocinadores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productora_id')->unsigned();
            $table->integer('competencia_id')->unsigned();
            $table->integer('imagen_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');
            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');
            $table->foreign('imagen_id')->references('id')->on('imagenes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patrocinadores');
    }
}
