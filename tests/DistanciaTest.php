<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Distancia;

class DistanciaTest extends TestCase
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
        $this->message('Iniciando Test Distancia');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test Distancia Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'fecha_id' => 1,
            'nombre' => 'NOM_001',
            'status' => 1
        ];

        $modelo = new Distancia();

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
        $modelo = Distancia::where('nombre', 'NOM_001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'],           
            'fecha_id' => 2,
            'nombre' => 'NOM_002',
            'status' => 2
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
        $modelos = Distancia::where('nombre', 'NOM_002')->withTrashed()->get();
        $modelo = new Distancia();
        foreach($modelos as $m)
        {           
            $modelo->delete(['nombre' => 'NOM_002']);

            $this->imprimir(Distancia::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('distancias')->where('id', $m['id'])->delete();
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
        echo 'fecha_id: ' . $modelo['fecha_id']. PHP_EOL;       
        echo 'nombre: ' . $modelo['nombre']. PHP_EOL;
        echo 'status: ' . $modelo['status']. PHP_EOL;       
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL;               
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;       
    }   

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }

}