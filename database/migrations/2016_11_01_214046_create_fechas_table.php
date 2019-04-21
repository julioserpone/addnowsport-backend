<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('competencia_id')->unsigned();
            $table->dateTime('fecha_competencia')->nullable();
            $table->longText('ubicacion')->nullable();
            $table->integer('paso')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fechas');
    }
}
