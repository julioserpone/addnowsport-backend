<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\WebPay;

class WebPayTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->withoutMiddleware();
        $this->message('Iniciando Test WebPay');

        $this->create();
        $this->update();
        $this->delete();

        $this->message('Test WebPay Finalizado con exito');
        $this->assertTrue(true);

    }

    public function create()
    {
        $attributes = [
            'orden_compra' => 'OC_123',
            'monto' => 12,5,
            'tipo_transaccion' => '1',
            'tipo_pago' => '1',
            'numero_cuotas' => '2',
            'fecha_transaccion' => \DB::raw('CURRENT_TIMESTAMP'),
            'fecha_contable' => '3',
            'codigo_autorizacion' => '4',
            'id_transaccion' => '4',
            'id_sesion' => '5',
            'final_numero_tarjeta' => '5'];

        $modelo = new WebPay();

        if(!$modelo->exist(['orden_compra' => 'OC_123']))
        {
            $this->message('Creando el registro');
            $id = WebPay::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = WebPay::where('orden_compra', 'OC_123')->first();
        $attributes2 = [
            'id' => $modelo['id'],
            'orden_compra' => 'OC_12345',
            'monto' => 5250.25,
            'tipo_transaccion' => '1',
            'tipo_pago' => '1',
            'numero_cuotas' => '2',
            'fecha_transaccion' => \DB::raw('CURRENT_TIMESTAMP'),
            'fecha_contable' => '3',
            'codigo_autorizacion' => '4',
            'id_transaccion' => '4',
            'id_sesion' => '5',
            'final_numero_tarjeta' => '5'];

        $this->message('Actualizando el registro');
        $modelo->update($attributes2);
        $this->imprimir($modelo);
        $this->assertTrue(true);
    }

    public function delete()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = WebPay::where('orden_compra', 'OC_12345')->get();
        $modelo = new WebPay();
        foreach($modelos as $m)
        {
            $this->imprimir($m);
            $modelo->delete(['orden_compra' => 'OC_12345']);

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('webpay')->where('id', $m['id'])->delete();
        }

        if(!$modelo->exist(['orden_compra' => 'OC_12345']))
        {
            $this->message('No se pudo eliminar el registro');
            $this->assertTrue(true);
        }
        else
         {
           $this->assertTrue(false);
        }

    }

    public function imprimir($modelo)
    {
        echo 'id: ' . $modelo['id'] . PHP_EOL;
        echo 'orden de compra: ' . $modelo['orden_compra']. PHP_EOL;
        echo 'monto: ' . $modelo['monto']. PHP_EOL;
        echo 'tipo_transaccion: ' . $modelo['tipo_transaccion']. PHP_EOL;
        echo 'tipo_pago: ' . $modelo['tipo_pago']. PHP_EOL;
        echo 'numero_cuotas: ' . $modelo['numero_cuotas']. PHP_EOL;
        echo 'fecha_transaccion: ' . $modelo['fecha_transaccion']. PHP_EOL;
        echo 'codigo_autorizacion: ' . $modelo['codigo_autorizacion']. PHP_EOL;
        echo 'id_transaccion: ' . $modelo['id_transaccion']. PHP_EOL;
        echo 'id_sesion: ' . $modelo['id_sesion']. PHP_EOL;
        echo 'final_numero_tarjeta: ' . $modelo['final_numero_tarjeta']. PHP_EOL;
        echo 'orden de compra: ' . $modelo['orden_compra']. PHP_EOL;
        echo 'status: ' . $modelo['status']. PHP_EOL;
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }

}
