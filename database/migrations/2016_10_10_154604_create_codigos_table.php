<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('productora_id')->unsigned();
            $table->string('codigo');
            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento');
            $table->integer('limite_uso_cupon');
            $table->integer('limite_uso_usuario');
            $table->enum('tipo', array_keys(trans('tipos.descuentos')))->default('descuento');
            $table->enum('estatus', array_keys(trans('tipos.estatus_descuento')))->default('activo');
            $table->decimal('porcentaje_descuento', 10, 2)->default(0.0)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
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
        Schema::dropIfExists('codigos');
    }
}
