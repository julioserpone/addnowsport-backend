<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoras', function(Blueprint $table)
        {

            $table->increments('id');         
            $table->integer('usuario_id')->unsigned()->default(0);
            $table->integer('imagen_id')->unsigned()->default(2);
            $table->string('cuit')->nullable();
            $table->string('rut')->nullable();
            $table->string('giro')->nullable();
            $table->string('nombre')->nullable();
            $table->string('pais')->nullable();
            $table->string('provincia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('prefijo_t')->nullable();
            $table->string('telefono')->nullable();
            $table->string('prefijo_c')->nullable();
            $table->string('celular')->nullable();
            $table->string('pin_retiro')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('slug')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('web')->nullable();
            $table->softDeletes();                      
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('imagen_id')->references('id')->on('imagenes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productoras');
    }
}
