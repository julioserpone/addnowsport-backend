<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistanciaFechaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distancia_fecha', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('distancia_id')->unsigned();
            $table->integer('fecha_id')->unsigned();
            $table->integer('edad_desde')->default(0);
            $table->integer('edad_hasta')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('distancia_id')->references('id')->on('distancias')->onDelete('cascade');
            $table->foreign('fecha_id')->references('id')->on('fechas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distancia_fecha');
    }
}
