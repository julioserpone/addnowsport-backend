<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'system' => [
                'nombre' => 'Administrador',
                'slug' => 'system',
                'permissions' => [
                    'superusuario' => true,
                    'administar.sistema' => true,
                    'ver.administracion' => true,
                    'ver.opciones.administrador' => true,
                    'ver.datos_personales' => true,
                    'ver.cambiar_contraseña' => true,
                ],
            ],
            'soporte' => [
                'nombre' => 'Soporte',
                'slug' => 'soporte',
                'permissions' => [
                    'ver.administracion' => true,
                    'ver.opciones.soporte' => true,
                    'ver.datos_personales' => true,
                    'ver.cambiar_contraseña' => true,
                ],
            ],
            'administradora' => [
                'nombre' => 'Administradora',
                'slug' => 'administradora',
                'permissions' => [
                    'ver.administracion' => true,
                    'ver.opciones.productora' => true,
                    'ver.mensajes' => true,
                    'ver.datos_principales' => true,
                    'ver.datos_cuenta_bancaria' => true,
                    'ver.pin' => true,
                    'crear.nueva_competencia' => true,
                    'ver.mis_competencias' => true,
                    'ver.lista_inscritos' => true,
                    'ver.codigo_inscripcion' => true,
                    'ver.carga_tiempos' => true,
                    'ver.exportar_resultados' => true,
                    'ver.ventas_realizadas' => true,
                    'ver.retirar_fondos' => true,
                    'ver.datos_personales' => true,
                    'ver.cambiar_contraseña' => true,
                ],
            ],
            'productora' => [
                'nombre' => 'Productora',
                'slug' => 'productora',
                'permissions' => [
                    'ver.administracion' => true,
                    'ver.opciones.productora' => true,
                    'ver.mensajes' => true,
                    'ver.datos_principales' => true,
                    'ver.datos_cuenta_bancaria' => true,
                    'ver.pin' => true,
                    'crear.nueva_competencia' => true,
                    'ver.mis_competencias' => true,
                    'ver.lista_inscritos' => true,
                    'ver.codigo_inscripcion' => true,
                    'ver.carga_tiempos' => true,
                    'ver.exportar_resultados' => true,
                    'ver.ventas_realizadas' => true,
                    'ver.retirar_fondos' => true,
                ],
            ],
            'usuario' => [
                'nombre' => 'Usuario',
                'slug' => 'usuario',
                'permissions' => [
                    'ver.administracion' => true,
                    'ver.opciones.usuario' => true,
                    'ver.datos_personales' => true,
                    'ver.cambiar_contraseña' => true,
                    'ver.mis_inscripciones' => true,
                    'ver.mis_resultados' => true,
                    'ver.codigos' => true,
                    'ver.mis_favoritos' => true,
                    'ver.mensajes' => true,
                ],
            ],
        ];

        foreach ($roles as $key => $rol) {
            DB::table('roles')->insert([
                'nombre' => $rol['nombre'],
                'permissions' => json_encode($rol['permissions']),
                'slug' => $key,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}
