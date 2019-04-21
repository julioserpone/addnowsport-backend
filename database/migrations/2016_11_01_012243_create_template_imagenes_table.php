<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_imagenes', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('templateSlider_id')->unsigned();
            $table->text('imagen')->nullable();
            $table->string('titulo')->nullable();
            $table->string('texto')->nullable();
            $table->boolean('boton')->nullable();
            $table->string('nombre_boton')->nullable();
            $table->text('vinculo_boton')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('templateSlider_id')->references('id')->on('template_sliders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_imagenes');
    }
}
