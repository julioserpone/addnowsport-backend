<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigoCompetenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_competencia', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('codigo_id')->unsigned();
            $table->integer('competencia_id')->unsigned();
            $table->decimal('valor_descuento', 8, 2)->default(0.0)->nullable();
            $table->decimal('valor_a_pagar', 8, 2)->default(0.0)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('codigo_id')->references('id')->on('codigos');
            $table->foreign('competencia_id')->references('id')->on('competencias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigo_competencia');
    }
}
