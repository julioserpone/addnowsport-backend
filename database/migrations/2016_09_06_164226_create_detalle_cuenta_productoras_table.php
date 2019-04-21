<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCuentaProductorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cuenta_productoras', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('cuenta_id')->unsigned();
            $table->enum('tipo_movimiento', array_keys(trans('tipos.movimientos')))->default('ingreso');
            $table->integer('cantidad');
            $table->decimal('valor', 8, 2);
            $table->string('detalle');
            $table->decimal('sub_total', 8, 2);  
            $table->softDeletes();          
            $table->timestamps();
            
            $table->foreign('cuenta_id')->references('id')->on('datos_bancarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_cuenta_productoras');
    }
}
