<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Competencia;

class CompetenciaTest extends TestCase
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
        $this->message('Iniciando Test Competencia');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test Competencia Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'productora_id' => 1,
            'nombre' => 'NOM_001',   
            'costo' => 1.0,                   
            'disciplina' => 'DIC001',
            'subtitulado' => 'SUBT001',
            'descripcion' => 'DESC001',
            'bases' => 'BAS001',
            'status' => 1,
        ];

        $modelo = new Competencia();

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
        $modelo = Competencia::where('nombre', 'NOM_001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'],  
            'nombre' => 'NOM_002',   
            'costo' => 2.0,                   
            'disciplina' => 'DIC002',
            'subtitulado' => 'SUBT002',
            'descripcion' => 'DESC002',
            'bases' => 'BAS002',
            'status' => 1,
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
        $modelos = Competencia::where('nombre', 'NOM_002')->withTrashed()->get();
        $modelo = new Competencia();
        foreach($modelos as $m)
        {           
            $modelo->delete(['nombre' => 'NOM_002']);

            $this->imprimir(Competencia::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('competencias')->where('id', $m['id'])->delete();
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
        echo 'disciplina: ' . $modelo['disciplina']. PHP_EOL;
        echo 'subtitulado: ' . $modelo['subtitulado']. PHP_EOL;
        echo 'descripcion: ' . $modelo['descripcion']. PHP_EOL;
        echo 'bases: ' . $modelo['bases']. PHP_EOL;
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