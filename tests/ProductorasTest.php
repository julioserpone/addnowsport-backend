<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Productora;

class ProductorasTest extends TestCase
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
        $this->message('Iniciando Test Productora');

        $this->create();
        $this->update();
        $this->destroy();
        
        $this->message('Test Productora Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
            'datos_banco_id' => 1,
            'usuario_id' => 1,
            'rut' => 'RUT_001',
            'giro' => 'GI_001',
            'nombre' => 'NOM_001',
            'pais' => 'PAIS_001',
            'ciudad' => 'CIUDAD_001', 
            'razon_social' => 'RA_001',
            'correo' => 'correo@correo.com',
            'direccion' => 'DIR_001',
            'telefono' => '12345678',
            'celular' => '12345678',
            'pin_retiro' => 'PIN_001',
            'descripcion' => 'DESC_001',
            'slug' => 'SLUG_001',
            'facebook' => 'FACE_001',
            'twitter' => 'TWI_001',
            'google' => 'GOO_001'
        ];

        $modelo = new Productora();

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
        $modelo = Productora::where('nombre', 'NOM_001')->first();
        $attributes2 = [ 
            'id' => $modelo['id'],           
            'rut' => 'RUT_002',
            'giro' => 'GI_002',
            'nombre' => 'NOM_002',
            'pais' => 'PAIS_002',
            'ciudad' => 'CIUDAD_002', 
            'razon_social' => 'RA_002',
            'correo' => 'correo2@correo.com',
            'direccion' => 'DIR_002',
            'telefono' => '12345672',
            'celular' => '12345672',
            'pin_retiro' => 'PIN_002',
            'descripcion' => 'DESC_002',
            'slug' => 'SLUG_002',
            'facebook' => 'FACE_002',
            'twitter' => 'TWI_002',
            'google' => 'GOO_002'
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
        $modelos = Productora::where('nombre', 'NOM_002')->withTrashed()->get();
        $modelo = new Productora();
        foreach($modelos as $m)
        {           
            $modelo->delete(['nombre' => 'NOM_002']);

            $this->imprimir(Productora::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('productoras')->where('id', $m['id'])->delete();
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
        echo 'rut: ' . $modelo['rut']. PHP_EOL;
        echo 'giro: ' . $modelo['giro']. PHP_EOL;
        echo 'nombre: ' . $modelo['nombre']. PHP_EOL;
        echo 'pais: ' . $modelo['pais']. PHP_EOL;
        echo 'ciudad: ' . $modelo['ciudad']. PHP_EOL;
        echo 'razon_social: ' . $modelo['razon_social']. PHP_EOL;
        echo 'correo: ' . $modelo['correo']. PHP_EOL;
        echo 'direccion: ' . $modelo['direccion']. PHP_EOL;
        echo 'telefono: ' . $modelo['telefono']. PHP_EOL;
        echo 'celular: ' . $modelo['celular']. PHP_EOL;
        echo 'pin_retiro: ' . $modelo['pin_retiro']. PHP_EOL;
        echo 'descripcion: ' . $modelo['descripcion']. PHP_EOL;
        echo 'slug: ' . $modelo['slug']. PHP_EOL;
        echo 'facebook: ' . $modelo['facebook']. PHP_EOL;
        echo 'twitter: ' . $modelo['twitter']. PHP_EOL;
        echo 'google: ' . $modelo['google']. PHP_EOL; 
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL;               
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }   

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }

}