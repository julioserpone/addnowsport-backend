<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Fecha;

class FechaTest extends TestCase
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
        $this->message('Iniciando Test Fecha');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test Fecha Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'competencia_id' => 1,
            'fecha' => '2016-09-16',           
            'costo_individual' => 1,
            'costo_grupal' => 8,
            'titulo' => 'TIT001',
            'texto_adicional' => 'TEXT001',
            'bases' => 'BAS001',
            'cant_integrantes' => 10 
        ];

        $modelo = new Fecha();

        if(!$modelo->exist(['titulo' => 'TIT001']))
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
        $modelo = Fecha::where('titulo', 'TIT001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'],           
            'competencia_id' => 2,
            'fecha' => '2016-09-18',           
            'costo_individual' => 2,
            'costo_grupal' => 35,
            'titulo' => 'TIT002',
            'texto_adicional' => 'TEXT002',
            'bases' => 'BAS002',
            'cant_integrantes' => 20 
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
        $modelos = Fecha::where('titulo', 'TIT002')->withTrashed()->get();
        $modelo = new Fecha();
        foreach($modelos as $m)
        {           
            $modelo->delete(['titulo' => 'TIT002']);

            $this->imprimir(Fecha::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('fechas')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['titulo' => 'TIT002']))
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
        echo 'competencia_id: ' . $modelo['competencia_id']. PHP_EOL;
        echo 'fecha: ' . $modelo['fecha']. PHP_EOL;
        echo 'costo_individual: ' . $modelo['costo_individual']. PHP_EOL;
        echo 'costo_grupal: ' . $modelo['costo_grupal']. PHP_EOL;
        echo 'titulo: ' . $modelo['titulo']. PHP_EOL;
        echo 'texto_adicional: ' . $modelo['texto_adicional']. PHP_EOL;
        echo 'bases: ' . $modelo['bases']. PHP_EOL;       
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL;               
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;        
    }   

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }

}