<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->enum('tipo', array_keys(trans('tipos.movimientos')))->default('ingreso');
            $table->enum('origen_transaccion', array_keys(trans('tipos.origen_transaccion')))->default('webpay');
            $table->string('nro', 20);
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->string('comprobante', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
