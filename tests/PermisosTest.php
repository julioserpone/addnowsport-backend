<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Permisos;

class PermisosTest extends TestCase
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
        $this->message('Iniciando Test Permisos');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test Permisos Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = ['nombre' => 'permiso1'];

        $modelo = new Permisos();

        if(!$modelo->exist(['nombre' => 'permiso1']))
        {
            $this->message('Creando el registro');
            $id = Permisos::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = Permisos::where('nombre', 'permiso1')->first();
        $attributes2 = ['id' => $modelo['id'], 'nombre' => 'Todospermisos'];

        $this->message('Actualizando el registro');
        $modelos = $modelo->update($attributes2);
        $modelos = $modelo->getModelById($modelo['id']);
        $this->imprimir($modelos);
        $this->assertTrue(true);
    }

        public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = Permisos::where('nombre', 'Todospermisos')->withTrashed()->get();
        $modelo = new Permisos();
        foreach($modelos as $m)
        {
            
            $modelo->delete(['nombre' => 'Todospermisos']);

            $this->imprimir(Permisos::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('permisos')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['nombre' => 'Todospermisos']))
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
