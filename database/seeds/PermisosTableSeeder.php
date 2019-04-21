<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $permisos = [
            'superusuario',
            'administar.sistema',
            'crear.nueva_competencia',
            'ver.administracion',
            'ver.cambiar_contraseña',
            'ver.carga_tiempos',
            'ver.codigo_inscripcion',
            'ver.codigos',
            'ver.datos_cuenta_bancaria',
            'ver.datos_personales',
            'ver.datos_principales',
            'ver.exportar_resultados',
            'ver.lista_inscritos',
            'ver.mensajes',
            'ver.mis_competencias',
            'ver.mis_favoritos',
            'ver.mis_inscripciones',
            'ver.mis_resultados',
            'ver.opciones.administrador',
            'ver.opciones.productora',
            'ver.opciones.soporte',
            'ver.opciones.usuario',
            'ver.pin',
            'ver.retirar_fondos',
            'ver.ventas_realizadas',
        ];

        foreach ($permisos as $key => $permiso) {
            DB::table('permisos')->insert([
                'nombre' => $permiso,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}
