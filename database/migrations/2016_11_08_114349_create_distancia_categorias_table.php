<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistanciaCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distancia_categorias', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('distancia_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('distancia_id')->references('id')->on('distancias')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distancia_categorias');
    }
}
