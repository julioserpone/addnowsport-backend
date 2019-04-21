<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\DatosBancos;

class DatosBancosTest extends TestCase
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
        $this->message('Iniciando Test Datos de Bancos');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test Datos de Bancos Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = ['titular' => 'tutular1',
        'rut' => 'asdasdasdas',
        'nro_cuenta' => '23423432423423',
        'banco' => 'banco1'];

        $modelo = new DatosBancos();

        if(!$modelo->exist(['titular' => 'tutular1']))
        {
            $this->message('Creando el registro');
            $id = DatosBancos::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = DatosBancos::where('titular', 'tutular1')->first();
        $attributes2 = ['id' => $modelo['id'], 'titular' => 'tutular2',
        'rut' => '4324234234',
        'nro_cuenta' => '23423432423423',
        'banco' => 'banco2'];

        $this->message('Actualizando el registro');
        $modelos = $modelo->update($attributes2);
        $modelos = $modelo->getModelById($modelo['id']);
        $this->imprimir($modelos);
        $this->assertTrue(true);
    }

        public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = DatosBancos::where('titular', 'titular2')->withTrashed()->get();
        $modelo = new DatosBancos();
        foreach($modelos as $m)
        {
            
            $modelo->delete(['titular' => 'titular2']);

            $this->imprimir(DatosBancos::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('datos_bancos')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['titular' => 'titular2']))
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
        echo 'titular: ' . $modelo['titular']. PHP_EOL;
        echo 'rut: ' . $modelo['rut']. PHP_EOL;
        echo 'nro_cuenta: ' . $modelo['nro_cuenta']. PHP_EOL;
        echo 'banco: ' . $modelo['banco']. PHP_EOL;
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL; 
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }
}
