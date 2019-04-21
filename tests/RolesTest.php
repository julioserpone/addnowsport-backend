<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modelos\Roles;

class RolesTest extends TestCase
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
        $this->message('Iniciando Test Roles');

        $this->create();
        $this->update();
        $this->destroy();

        $this->message('Test Roles Finalizado con exito');
        $this->assertTrue(true);
    }

    public function create()
    {
        $attributes = ['nombre' => 'invitado',
        			   'permissions' => 'todospermisos',
                       'slug' => 'slug1'
        			  ];

        $modelo = new Roles();

        if(!$modelo->exist(['nombre' => 'invitado']))
        {
            $this->message('Creando el registro');
            $id = Roles::create($attributes);
            $modelo = $modelo->getModelById($id);
            $modelo['id'] = $id;
            $this->imprimir($modelo);
        }
    }

    public function update()
    {
        $modelo = Roles::where('nombre', 'invitado')->first();
        $attributes2 = ['id' => $modelo['id'],
        				'nombre' => 'invitado2',
        				'permissions' => 'permisouno',
                        'slug' => 'slug2'
                        ];

        $this->message('Actualizando el registro');
        $modelos = $modelo->update($attributes2);
        $modelos = $modelo->getModelById($modelo['id']);
        $this->imprimir($modelos);
        $this->assertTrue(true);
    }

        public function destroy()
    {
        $this->message('Aplicando soft-delete al registro');
        $modelos = Roles::where('nombre', 'invitado2')->withTrashed()->get();
        $modelo = new Roles();
        foreach($modelos as $m)
        {
            
            $modelo->delete(['nombre' => 'invitado2']);

            $this->imprimir(Roles::where('id', $m['id'])->withTrashed()->first());

            $this->message('Eliminando el resgitro ' . $m['id']);
            \DB::table('roles')->where('id', $m['id'])->delete();
        }

        if($modelo->exist(['nombre' => 'invitado2']))
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
        echo 'Nombre: ' . $modelo['nombre']. PHP_EOL;
        echo 'Permisos: ' . $modelo['permissions']. PHP_EOL;
        echo 'Slug: ' . $modelo['slug']. PHP_EOL;
        echo 'deleted_at: ' . $modelo['deleted_at']. PHP_EOL; 
        echo 'created_at: ' . $modelo['created_at']. PHP_EOL;
        echo 'updated_at: ' . $modelo['updated_at']. PHP_EOL . PHP_EOL;
    }

    public function message($message)
    {
        echo $message . PHP_EOL .PHP_EOL;
    }
}
