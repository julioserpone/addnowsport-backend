<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('productora_id')->unsigned();
            $table->integer('competencia_id')->unsigned();
            $table->integer('distancia_id')->unsigned();
            $table->integer('movimiento_id')->unsigned();
            $table->dateTime('fecha');
            $table->integer('nro_inscriptos')->unsigned();
            $table->decimal('valor',10,2);
            $table->decimal('descuento',10,2);
            $table->decimal('ingreso',10,2);
            $table->decimal('comision',10,2);
            $table->decimal('total',10,2);
            $table->enum('estado', array_keys(trans('tipos.ventas')))->default('nominal');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');
            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');
            $table->foreign('distancia_id')->references('id')->on('distancias')->onDelete('cascade');
            $table->foreign('movimiento_id')->references('id')->on('movimientos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
