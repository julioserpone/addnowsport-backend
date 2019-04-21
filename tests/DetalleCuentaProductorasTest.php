<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\DetalleCuentaProductora;

class DetalleCuentaProductoraTest extends TestCase
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
        $this->message('Iniciando Test DetalleCuentaProductora');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test DetalleCuentaProductora Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'cuenta_id' => 1,
            'tipo_moviento' => 1,
            'cantidad' => 1,
            'valor' => 1.0,
            'detalle' => 'DET_001',
            'sub_total' => 1.0
        ];

        $modelo = new DetalleCuentaProductora();

        if(!$modelo->exist(['detalle' => 'DET_001']))
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
        $modelo = DetalleCuentaProductora::where('detalle', 'DET_001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'], 
            'tipo_moviento' => 2,
            'cantidad' => 2,
            'valor' => 2.0,
            'detalle' => 'DET_002',
            'sub_total' => 2.0
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
        $modelos = DetalleCuentaProductora::where('detalle', 'DET_002')->withTrashed()->get();
        $modelo = new DetalleCuentaProductora();
        foreach($modelos as $m)
        {           
            $modelo->delete(['detalle' => 'DET_002']);

            $this->imprimir(DetalleCuentaProductora::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('detalle_cuenta_productoras')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['detalle' => 'DET_002']))
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
        echo 'tipo_moviento: ' . $modelo['tipo_moviento']. PHP_EOL;
        echo 'cantidad: ' . $modelo['cantidad']. PHP_EOL;
        echo 'valor: ' . $modelo['valor']. PHP_EOL;
        echo 'detalle: ' . $modelo['detalle']. PHP_EOL;
        echo 'sub_total: ' . $modelo['sub_total']. PHP_EOL;       
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL;               
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;        
    }   

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }

}