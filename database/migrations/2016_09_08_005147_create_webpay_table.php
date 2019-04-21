<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebpayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webpay', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('orden_compra');
            $table->integer('tipo_transaccion')->default(0)->unsigned();
            $table->decimal('monto',10,2)->default(0.0)->unsigned();
            $table->text('id_sesion');
            $table->integer('tipo_pago')->default(0)->unsigned();
            $table->integer('numero_cuotas')->default(0)->unsigned();
            $table->timestamp('fecha_transaccion')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('fecha_contable', 50);
            $table->string('codigo_autorizacion');
            $table->integer('movimiento_id')->unsigned();
            $table->string('final_numero_tarjeta');
            $table->integer('status')->default(0)->comment('0 -> Null','1 -> Aceptado','2 -> Rechazado');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('movimiento_id')->references('id')->on('movimientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webpay');
    }
}
