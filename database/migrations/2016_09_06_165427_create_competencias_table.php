<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencias', function(Blueprint $table)
        {   
            $table->increments('id');        
            $table->integer('productora_id')->unsigned();
            $table->integer('disciplina_id')->unsigned()->nullable();
            $table->integer('imagen_id')->unsigned()->nullable();
            $table->string('nombre')->nullable();
            $table->string('dominio')->nullable();
            $table->string('subdominio')->nullable();
            $table->decimal('costo', 10, 2)->default(0.0)->nullable();
            $table->decimal('costo_individual', 10, 2)->default(0.0)->nullable();
            $table->string('titulo')->nullable();
            $table->text('texto')->nullable();
            $table->string('subtitulado')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('bases')->nullable();
            $table->integer('cantidad_integrantes')->unsigned()->nullable();;
            $table->enum('estatus', array_keys(trans('tipos.estatus')))->default('activo');
            $table->enum('tipo', array_keys(trans('tipos.competencias')))->default('competencia');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->longText('json')->nullable();
            $table->boolean('completa')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
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
        Schema::dropIfExists('competencias');
    }
}
