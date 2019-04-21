<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('propietario_id')->unsigned();
            $table->enum('tipo', array_keys(trans('tipos.slider')));
            $table->integer('total')->unsigned();
            $table->integer('efecto')->unsigned();
            $table->enum('status', array_keys(trans('tipos.estatus')))->default('activo');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
