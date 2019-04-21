<?php

use App\Modelos\Distancia;
use App\Modelos\Fecha;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DistanciaFechaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1,40) as $index) {
        DB::table('distancia_fecha')->insert([
            'fecha_id' => Fecha::select(['id'])->orderByRaw('RAND()')->first()->id,
            'distancia_id' => Distancia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'edad_desde' => $faker->numberBetween($min = 10, $max = 15),
            'edad_hasta' => $faker->numberBetween($min = 30, $max = 40),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}           
