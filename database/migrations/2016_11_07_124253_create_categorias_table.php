<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productora_id')->unsigned();
            $table->string('nombre');
            $table->tinyInteger('edad_inicio')->default(0);  
            $table->tinyInteger('edad_final')->default(0);
            $table->integer('grupo_id')->unsigned()->nullable();
            $table->softDeletes();                   
            $table->timestamps();

            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
