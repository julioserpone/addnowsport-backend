<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PerfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
      foreach (range(1,4) as $index) {
        DB::table('perfiles')->insert([
        	'usuario_id' => $index,
            'proveedor' => $faker->randomElement(array_keys(trans('tipos.proveedores'))),
            'usuario_social_id' => $faker->randomNumber(9),
            'identificacion' => $faker->randomNumber(9),
            'genero' => $faker->randomElement(array_keys(trans('tipos.generos'))),
            'telefono' => $faker->tollFreePhoneNumber,
            'pais' => $faker->randomElement(array_keys(trans('pais'))),
            'ciudad' => $faker->city,
            'profesion' => $faker->company,
            'descripcion' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'prefijo' => '0414',
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }
    }
}
