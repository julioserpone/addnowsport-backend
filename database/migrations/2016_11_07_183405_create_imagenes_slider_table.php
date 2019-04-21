<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_sliders', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('imagen_id')->unsigned();
            $table->integer('slider_id')->unsigned();
            $table->string('titulo')->nullable();
            $table->string('texto')->nullable();
            $table->boolean('boton')->nullable();
            $table->string('nombre_boton')->nullable();
            $table->text('vinculo_boton')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('imagen_id')->references('id')->on('imagenes')->onDelete('cascade');
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes_sliders');
    }
}
