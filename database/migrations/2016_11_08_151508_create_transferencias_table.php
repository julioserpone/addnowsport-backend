<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productora_id')->unsigned();
            $table->dateTime('fecha_solicitud');
            $table->dateTime('fecha_solventada')->nullable();
            $table->string('nro_operacion');
            $table->string('codigo');
            $table->decimal('monto', 10, 2);
            $table->enum('estado', array_keys(trans('tipos.transferencias')))->nullable();
            $table->enum('rc', array_keys(trans('tipos.rc')))->nullable();
            $table->string('recibo');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transferencias');
    }
}
