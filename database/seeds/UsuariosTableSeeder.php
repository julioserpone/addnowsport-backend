<?php

use Illuminate\Database\Seeder;
use App\Modelos\Rol;
use App\Modelos\Usuario;
use Faker\Factory as Faker;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $usuarios = [
            [
                'email' => 'admin@psp.com',
                'nombre' => 'Administrador',
                'apellido' => 'PSP',
                'username' => 'admin',
                'role' => 'system',
            ],
            [
                'email' => 'soporte@psp.com',
                'nombre' => 'Soporte',
                'apellido' => 'PSP',
                'username' => 'soporte',
                'role' => 'soporte',
            ],
            [
                'email' => 'administradora1@psp.com',
                'nombre' => 'Administradora',
                'apellido' => 'Productoras #1',
                'username' => 'administradora1',
                'role' => 'administradora',
            ],
            [
                'email' => 'administradora2@psp.com',
                'nombre' => 'Administradora',
                'apellido' => 'Productoras #2',
                'username' => 'administradora2',
                'role' => 'administradora',
            ],
            [
                'email' => 'productora1@psp.com',
                'nombre' => 'Productora',
                'apellido' => 'PSP #1',
                'username' => 'productora1',
                'role' => 'productora',
            ],
            [
                'email' => 'productora2@psp.com',
                'nombre' => 'Productora',
                'apellido' => 'PSP #2',
                'username' => 'productora2',
                'role' => 'productora',
            ],
            [
                'email' => 'usuario@psp.com',
                'nombre' => 'Usuario',
                'apellido' => 'PSP',
                'username' => 'usuario',
                'role' => 'usuario',
            ],
        ];

        foreach ($usuarios as $key => $item) {
            $usuario = Usuario::create([
                'nombre' => $item['nombre'],
                'apellido' => $item['apellido'],
                'email' => $item['email'],
                'password' => hash(env('ENCRYPTION_ALGORITHM'),'12345678'),
                'fecha_nacimiento' => $faker->dateTimeBetween($startDate = '-20 years', $endDate = 'now'),
                'username' => $item['username'],
                'last_login' =>  $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
                'usuario' => $faker->numberBetween(1,2),
                'recordarme' => 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
            //asignacion de rol
            DB::table('rol_usuario')->insert([
                'usuario_id' => $usuario->id,
                'rol_id' => Rol::where('slug',$item['role'])->first()->id,
            ]);
        }
    }
}
