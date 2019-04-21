<?php

use App\Modelos\Productora;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransferenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1,5) as $index) {
        DB::table('transferencias')->insert([
            'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
            'fecha_solicitud' => $faker->dateTime($max = 'now'),
            'nro_operacion' => $faker->sha1,
            'codigo' => $faker->sha1,
            'monto' => $faker->randomFloat(2, 0.0, 1000.0),
            'estado' =>  $faker->randomElement(array_keys(trans('tipos.transferencias'))),
            'rc' =>  $faker->randomElement(array_keys(trans('tipos.rc'))),
            'recibo' => $faker->sha1,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}           
