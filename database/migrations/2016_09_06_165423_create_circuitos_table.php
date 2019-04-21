<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircuitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuitos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productora_id')->unsigned();
            $table->string('nombre')->nullable();
            $table->longText('puntos')->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('circuitos');
    }
}
