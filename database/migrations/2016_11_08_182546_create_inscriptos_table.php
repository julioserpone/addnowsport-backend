<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productora_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->integer('competencia_id')->unsigned();
            $table->integer('distancia_categoria_id')->unsigned();
            $table->integer('movimiento_id')->unsigned();
            $table->integer('team_usuario_id')->unsigned()->nullable();
            $table->dateTime('fecha');
            $table->string('nro_corredor', 15)->nullable();
            $table->string('tiempo_1', 50)->nullable();
            $table->string('tiempo_2', 50)->nullable();
            $table->string('tiempo_3', 50)->nullable();
            $table->string('tiempo_4', 50)->nullable();
            $table->string('tiempo_t', 50)->nullable();
            $table->integer('posicion')->default(0);
            $table->enum('genero', array_keys(trans('tipos.generos')));
            $table->integer('edad')->default(0); 
            $table->string('pais'); 
            $table->enum('status', array_keys(trans('tipos.estatus_inscripcion')))->default('nuevo');
            $table->softDeletes();           
            $table->timestamps();

            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');
            $table->foreign('distancia_categoria_id')->references('id')->on('distancia_categorias')->onDelete('cascade');
            $table->foreign('movimiento_id')->references('id')->on('movimientos')->onDelete('cascade');
            $table->foreign('team_usuario_id')->references('id')->on('team_usuario')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscriptos');
    }
}
