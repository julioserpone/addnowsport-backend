<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('stores', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('datos_banco_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->string('rut', 255);
            $table->string('razon_social', 255);
            $table->string('giro', 255);
            $table->string('correo', 255);
            $table->string('nombre', 255);
            $table->string('direccion', 255);
            $table->string('pais', 255);
            $table->string('telefono', 255);
            $table->string('ciudad', 255);
            $table->string('celular', 255);
            $table->string('pin_retiro', 255);
            $table->string('prefix', 255);
            $table->string('slug', 255);
            $table->double('monto_disponible');
            $table->double('comision', 0, 0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('datos_banco_id')->references('id')->on('datos_bancarios')->onDelete('cascade');
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
        Schema::dropIfExists('stores');
    }
}
