<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_sliders', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->enum('tipo', array_keys(trans('tipos.slider')));
            $table->integer('total')->unsigned();
            $table->integer('efecto')->unsigned();
            $table->enum('status', array_keys(trans('tipos.estatus')))->default('activo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('usuario_id')->references('id')->on('usuarios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_sliders');
    }
}
