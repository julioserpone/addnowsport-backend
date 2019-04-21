<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosBancariosProductorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_bancarios_productoras', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productora_id')->unsigned();
            $table->integer('datosbancarios_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('productora_id')->references('id')->on('productoras')->onDelete('cascade');
            $table->foreign('datosbancarios_id')->references('id')->on('datos_bancarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_bancarios_productoras');
    }
}
