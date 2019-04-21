<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Bancos;

class BancosTest extends TestCase
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
        $this->message('Iniciando Test Bancos');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test Bancos Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = ['nombre' => 'banco1'];

        $modelo = new Bancos();

        if(!$modelo->exist(['nombre' => 'banco1']))
        {
            $this->message('Creando el registro');
            $id = Bancos::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = Bancos::where('nombre', 'banco1')->first();
        $attributes2 = ['id' => $modelo['id'],
        				'nombre' => 'banco2'
        				];

        $this->message('Actualizando el registro');
        $modelos = $modelo->update($attributes2);
        $modelos = $modelo->getModelById($modelo['id']);
        $this->imprimir($modelos);
        $this->assertTrue(true);
    }

        public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = Bancos::where('nombre', 'banco2')->withTrashed()->get();
        $modelo = new Bancos();
        foreach($modelos as $m)
        {
            
            $modelo->delete(['nombre' => 'banco2']);

            $this->imprimir(Bancos::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('bancos')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['nombre' => 'banco2']))
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
        echo 'Nombre: ' . $modelo['nombre']. PHP_EOL;
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL; 
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }
}
