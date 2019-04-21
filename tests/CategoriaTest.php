<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Categoria;

class CategoriaTest extends TestCase
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
        $this->message('Iniciando Test Categoria');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test Categoria Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'distancia_id' => 1,
            'nombre' => 'CAT001',
            'edad_inicio' => 20,
            'edad_final' => 30,
            'texto_informativo' => 'TEXT001',
            'tipo' => 1
        ];

        $modelo = new Categoria();

        if(!$modelo->exist(['nombre' => 'CAT001']))
        {
            $this->message('Creando el registro');
            $id = $modelo->create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    } 

    public function update()
    {
        $modelo = Categoria::where('nombre', 'CAT001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'],
            'nombre' => 'CAT002',
            'edad_inicio' => 22,
            'edad_final' => 32,
            'texto_informativo' => 'TEXT002',
            'tipo' => 2
        ];

        $this->message('Actualizando el registro');
        $modelo2 = $modelo->update($attributes2);
        $modelo2 = $modelo->getModelById($modelo['id']);       
        $this->imprimir($modelo2);
        $this->assertTrue(true);
    }  

    public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = Categoria::where('nombre', 'CAT002')->withTrashed()->get();
        $modelo = new Categoria();
        foreach($modelos as $m)
        {           
            $modelo->delete(['nombre' => 'CAT002']);

            $this->imprimir(Categoria::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('categorias')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['nombre' => 'CAT002']))
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
        echo 'nombre: ' . $modelo['nombre']. PHP_EOL;
        echo 'edad_inicio: ' . $modelo['edad_inicio']. PHP_EOL;
        echo 'edad_final: ' . $modelo['edad_final']. PHP_EOL;
        echo 'texto_informativo: ' . $modelo['texto_informativo']. PHP_EOL;
        echo 'tipo: ' . $modelo['tipo']. PHP_EOL;       
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL;               
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }      

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }

}