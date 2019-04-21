<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Inscripto;

class InscriptoTest extends TestCase
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
        $this->message('Iniciando Test Inscripto');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test Inscripto Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'usuario_id' => 1,
            'categoria_id' => 1, 
            'competencia_id' => 1, 
            'distancia_id' => 1, 
            'operacion_id' => 1, 
            'fecha_id' => 1,
            'nro_corredor' => 1,
            'tiempo' => '01:20:46', 
            'posicion' => '1', 
            'team' => 'TEAM001',
            'sexo' => 1,
            'edad' => 19, 
            'pais' => 'Venezuela', 
            'status' => 1
        ];

        $modelo = new Inscripto();

        if(!$modelo->exist(['team' => 'TEAM001']))
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
        $modelo = Inscripto::where('team', 'TEAM001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'], 
            'usuario_id' => 2,
            'categoria_id' => 2, 
            'competencia_id' => 2, 
            'distancia_id' => 2, 
            'operacion_id' => 2, 
            'fecha_id' => 2,
            'nro_corredor' => 2,
            'tiempo' => '02:20:46', 
            'posicion' => '2', 
            'team' => 'TEAM002',
            'sexo' => 2,
            'edad' => 20, 
            'pais' => 'Argentina', 
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
        $modelos = Inscripto::where('team', 'TEAM002')->withTrashed()->get();
        $modelo = new Inscripto();
        foreach($modelos as $m)
        {           
            $modelo->delete(['team' => 'TEAM002']);

            $this->imprimir(Inscripto::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('inscriptos')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['team' => 'TEAM002']))
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
        echo 'usuario_id: ' . $modelo['usuario_id']. PHP_EOL;
        echo 'categoria_id: ' . $modelo['categoria_id']. PHP_EOL;
        echo 'competencia_id: ' . $modelo['competencia_id']. PHP_EOL;
        echo 'distancia_id: ' . $modelo['distancia_id']. PHP_EOL;
        echo 'operacion_id: ' . $modelo['operacion_id']. PHP_EOL;
        echo 'fecha_id: ' . $modelo['fecha_id']. PHP_EOL;
        echo 'nro_corredor: ' . $modelo['nro_corredor']. PHP_EOL;
        echo 'tiempo: ' . $modelo['tiempo']. PHP_EOL;
        echo 'posicion: ' . $modelo['posicion']. PHP_EOL;
        echo 'team: ' . $modelo['team']. PHP_EOL;
        echo 'sexo: ' . $modelo['sexo']. PHP_EOL;
        echo 'edad: ' . $modelo['edad']. PHP_EOL;
        echo 'pais: ' . $modelo['pais']. PHP_EOL;
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