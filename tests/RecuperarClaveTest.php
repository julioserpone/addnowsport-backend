<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\RecuperarClave;

class RecuperarClaveTest extends TestCase
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
        $this->message('Iniciando Test RecuperarClave');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test RecuperarClave Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
        'correo' => 'correo1@gmail.com',
        'token' => 'toke4354353443rfn',
        'status' => '1'];

        $modelo = new RecuperarClave();

        if(!$modelo->exist(['correo' => 'correo1@gmail.com']))
        {
            $this->message('Creando el registro');
            $id = RecuperarClave::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = RecuperarClave::where('correo', 'correo1@gmail.com')->first();
        $attributes2 = ['id' => $modelo['id'],
        'correo' => 'correo2@gmail.com',
        'token' => 'toke4354353443rfn',
        'status' => '0'];

        $this->message('Actualizando el registro');
        $modelos = $modelo->update($attributes2);
        $modelos = $modelo->getModelById($modelo['id']);
        $this->imprimir($modelos);
        $this->assertTrue(true);
    }

        public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = RecuperarClave::where('correo', 'correo2@gmail.com')->withTrashed()->get();
        $modelo = new RecuperarClave();
        foreach($modelos as $m)
        {
            
            $modelo->delete(['correo' => 'correo2@gmail.com']);

            $this->imprimir(RecuperarClave::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('recuperar_clave')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['correo' => 'correo2@gmail.com']))
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
        echo 'correo: ' . $modelo['correo']. PHP_EOL;
        echo 'token: ' . $modelo['token']. PHP_EOL;
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
