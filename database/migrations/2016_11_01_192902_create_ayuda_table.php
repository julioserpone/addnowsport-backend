<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyudaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayudas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productora_id')->default(0)->unsigned();
            $table->longText('json');
            $table->enum('seccion',  array_keys(trans('tipos.secciones')))->nullable();
            $table->dateTime('tiempo_inicio');
            $table->dateTime('tiempo_fin')->nullable();
            $table->boolean('solucionado')->nullable();
            $table->decimal('evaluacion',10,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayudas');
    }
}
