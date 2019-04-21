<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('usuarios', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 32);
            $table->string('apellido', 32);
            $table->string('email', 250)->unique();
            $table->text('password')->nullable();
            $table->dateTime('fecha_nacimiento')->nullable();
            $table->string('username')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('usuario')->default(true);
            $table->string('productora_activa')->nullable();
            $table->string('rol_activo')->default('usuario');
            $table->boolean('recordarme')->default(false);
            $table->boolean('social')->default(false);
            $table->enum('status', array_keys(trans('tipos.estatus')))->default('activo');
            $table->boolean('activado')->default(false);
            $table->string('nombre_contacto', 255)->nullable();
            $table->string('prefijo_contacto', 255)->nullable();
            $table->string('telefono_contacto', 255)->nullable();
            $table->text('derivacion_contacto')->nullable();
            $table->string('hash_activacion', 100)->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('rol_usuario', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('rol_id')->unsigned();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('rol_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_usuario');
        Schema::dropIfExists('usuarios');
    }
}
