<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('imagen_id')->unsigned()->default(1);
            $table->enum('proveedor', array_keys(trans('tipos.proveedores')));
            $table->string('usuario_social_id')->nullable();
            $table->text('usuario_social_attributes')->nullable();
            $table->string('identificacion')->nullable();
            $table->enum('genero', array_keys(trans('tipos.generos')));
            $table->string('prefijo', 255)->nullable();
            $table->string('telefono', 30)->nullable();
            $table->string('pais')->nullable();
            $table->string('provincia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('profesion')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('perfiles');
    }
}
