<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircuitosCompetenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuitos_competencias', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('competencia_id')->unsigned();
            $table->integer('circuito_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');
            $table->foreign('circuito_id')->references('id')->on('circuitos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('circuitos_competencias');
    }
}
