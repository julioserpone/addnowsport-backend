<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosBancariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_bancarios', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('banco_id')->unsigned()->nullable();
            $table->enum('tipo_cuenta', array_keys(trans('tipos.cuentas')))->nullable();
            $table->string('titular', 255)->nullable();
            $table->string('rut', 255)->nullable();
            $table->string('nro_cuenta', 255)->nullable();
            $table->string('banco', 255)->nullable();
            $table->text('correo')->nullable();
            $table->boolean('valida')->default(false);
            $table->enum('status', array_keys(trans('tipos.estatus')))->default('inactivo');
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
        Schema::dropIfExists('datos_bancarios');
    }
}
