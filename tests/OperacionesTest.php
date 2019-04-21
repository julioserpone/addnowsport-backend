<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Operaciones;

class OperacionesTest extends TestCase
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
        $this->message('Iniciando Test Operaciones');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test Operaciones Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
        'tipo' => '1',
        'nro' => '345345345345',
        'fecha' => '2016-06-06',
        'monto' => '222222',
        'comprobante' => '3333333'];

        $modelo = new Operaciones();

        if(!$modelo->exist(['nro' => '345345345345']))
        {
            $this->message('Creando el registro');
            $id = Operaciones::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = Operaciones::where('nro', '345345345345')->first();
        $attributes2 = ['id' => $modelo['id'],
        'tipo' => '2',
        'nro' => '555555555555',
        'fecha' => '2016-06-08',
        'monto' => '444444',
        'comprobante' => '7777777'];

        $this->message('Actualizando el registro');
        $modelos = $modelo->update($attributes2);
        $modelos = $modelo->getModelById($modelo['id']);
        $this->imprimir($modelos);
        $this->assertTrue(true);
    }

        public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = Operaciones::where('nro', '555555555555')->withTrashed()->get();
        $modelo = new Operaciones();
        foreach($modelos as $m)
        {
            
            $modelo->delete(['nro' => '555555555555']);

            $this->imprimir(Operaciones::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('operaciones')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['nro' => '555555555555']))
        {
            $this->message('No se pudo eliminar el registro');
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }

    }

    public function imprimir($modelo)
    {
        echo 'id: ' . $modelo['id'] . PHP_EOL;
        echo 'tipo: ' . $modelo['tipo']. PHP_EOL;
        echo 'nro: ' . $modelo['nro']. PHP_EOL;
        echo 'fecha: ' . $modelo['fecha']. PHP_EOL;
        echo 'monto: ' . $modelo['monto']. PHP_EOL;
        echo 'comprobante: ' . $modelo['comprobante']. PHP_EOL;
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL; 
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }
}
