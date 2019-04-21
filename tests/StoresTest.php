<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Stores;

class StoresTest extends TestCase
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
        $this->message('Iniciando Test Stores');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test Stores Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = ['datos_banco_id' => 3,
         'usuario_id' => 2,
         'rut' => 'ruta',
         'razon_social' => 'Razon',
         'giro' => 'giro',
         'correo' => 'correo@dfdf.com',
         'nombre' => 'nombre',
         'direccion' => 'direccion',
         'pais' => 'vene',
         'telefono' => '45435435',
         'ciudad' => 'maturin',
         'celular' => '032343232432',
         'pin_retiro' => '3423423',
         'prefix' => 'erewrwr',
         'slug' => 'slug',
         'monto_disponible' => '2342342',
         'comision' => '32432'];

        $modelo = new Stores();

        if(!$modelo->exist(['nombre' => 'nombre']))
        {
            $this->message('Creando el registro');
            $id = Stores::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = Stores::where('nombre', 'nombre')->first();
        $attributes2 = [
         'id' => $modelo['id'], 
         'datos_banco_id' => 3,
         'usuario_id' => 2,
         'rut' => 'ruta2',
         'razon_social' => 'Productos lacteos',
         'giro' => 'giro2',
         'correo' => 'correo2@dfdf.com',
         'nombre' => 'nombre2',
         'direccion' => 'direccion2',
         'pais' => 'vene2',
         'telefono' => '45435435',
         'ciudad' => 'maturin2',
         'celular' => '032343232432',
         'pin_retiro' => '3423423',
         'prefix' => 'erewrwr2',
         'slug' => 'slug2',
         'monto_disponible' => '2342342',
         'comision' => '32432'];

        $this->message('Actualizando el registro');
        $modelos = $modelo->update($attributes2);
        $modelos = $modelo->getModelById($modelo['id']);
        $this->imprimir($modelos);
        $this->assertTrue(true);
    }

        public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = Stores::where('nombre', 'nombre2')->withTrashed()->get();
        $modelo = new Stores();
        foreach($modelos as $m)
        {           
            $modelo->delete(['nombre' => 'nombre2']);

            $this->imprimir(Stores::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('stores')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['nombre' => 'nombre2']))
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
        echo 'datos_banco_id: ' . $modelo['datos_banco_id']. PHP_EOL; 
        echo 'usuario_id: ' . $modelo['usuario_id']. PHP_EOL;
        echo 'rut: ' . $modelo['rut']. PHP_EOL; 
        echo 'razon_social: ' . $modelo['razon_social']. PHP_EOL;
        echo 'giro: ' . $modelo['giro']. PHP_EOL; 
        echo 'correo: ' . $modelo['correo']. PHP_EOL;
        echo 'nombre: ' . $modelo['nombre']. PHP_EOL; 
        echo 'direccion: ' . $modelo['direccion']. PHP_EOL;
        echo 'pais: ' . $modelo['pais']. PHP_EOL; 
        echo 'telefono: ' . $modelo['telefono']. PHP_EOL;
        echo 'ciudad: ' . $modelo['ciudad']. PHP_EOL; 
        echo 'celular: ' . $modelo['celular']. PHP_EOL;
        echo 'pin_retiro: ' . $modelo['pin_retiro']. PHP_EOL; 
        echo 'prefix: ' . $modelo['prefix']. PHP_EOL;
        echo 'slug: ' . $modelo['slug']. PHP_EOL; 
        echo 'monto_disponible: ' . $modelo['monto_disponible']. PHP_EOL;
        echo 'comision: ' . $modelo['comision']. PHP_EOL; 
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL; 
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }
}
