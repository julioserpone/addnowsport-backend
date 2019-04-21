<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Premio;

class PremioTest extends TestCase
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
        $this->message('Iniciando Test Premio');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test Premio Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'nombre' => 'NOM_001',
            'descripcion' => 'DESC_001',
            'puesto' => '4',
            'monto' => 10.0
        ];

        $modelo = new Premio();

        if(!$modelo->exist(['nombre' => 'NOM_001']))
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
        $modelo = Premio::where('nombre', 'NOM_001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'],           
            'nombre' => 'NOM_002',
            'descripcion' => 'DESC_002',
            'puesto' => '8',
            'monto' => 20.0
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
        $modelos = Premio::where('nombre', 'NOM_002')->withTrashed()->get();
        $modelo = new Premio();
        foreach($modelos as $m)
        {           
            $modelo->delete(['nombre' => 'NOM_002']);

            $this->imprimir(Premio::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('premios')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['nombre' => 'NOM_002']))
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
        echo 'descripcion: ' . $modelo['descripcion']. PHP_EOL;
        echo 'puesto: ' . $modelo['puesto']. PHP_EOL;
        echo 'monto: ' . $modelo['monto']. PHP_EOL;       
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL;               
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;       
    }   

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }

}