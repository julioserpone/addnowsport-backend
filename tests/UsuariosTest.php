<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Usuarios;

class UsuariosTest extends TestCase
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
        $this->message('Iniciando Test Usuarios');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test Usuarios Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = [
        'rol_id' => '1',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'correo' => 'correo@gamill.com',
        'clave' => 'erwerew5235322',
        'fecha_nacimiento' => '30-04-1988',
        'username' => 'usernae',
        'permissions' => 'fkhfkjhdfkdfkjdfkgfgfkg',
        'last_login' =>  '',
        'usuario' => 1,
        'usuario_social_attributes' => 'jfjfggjg',
        'avatar' => 'dkbhklghgh',
        'avatar_original' => "cvkhfjkkh",
        'social' => 1,
        ];

        $modelo = new Usuarios();

        if(!$modelo->exist(['correo' => 'correo@gamill.com']))
        {
            $this->message('Creando el registro');
            $id = Usuarios::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = Usuarios::where('correo', 'correo@gamill.com')->first();
        $attributes2 = ['id' => $modelo['id'], 'rol_id' => '2',
        'nombre' => 'nombre',
        'apellido' => 'apellido2',
        'correo' => 'correo2@gamill.com',
        'clave' => '4534tretrete',
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
        $modelos = Usuarios::where('correo', 'correo2@gamill.com')->get();
        $modelo = new Usuarios();
        foreach($modelos as $m)
        {
            
            $modelo->delete(['correo' => 'correo2@gamill.com']);

            $this->imprimir(Usuarios::where('id', $m['id'])->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('usuarios')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['correo' => 'correo2@gamill.com']))
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
        echo 'rol_id: ' . $modelo['rol_id']. PHP_EOL;
        echo 'nombre: ' . $modelo['nombre']. PHP_EOL;
        echo 'apellido: ' . $modelo['apellido']. PHP_EOL;
        echo 'correo: ' . $modelo['correo']. PHP_EOL;
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
