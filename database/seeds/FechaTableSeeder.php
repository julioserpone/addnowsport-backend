<?php

use App\Modelos\Competencia;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FechaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1,45) as $index) {
        DB::table('fechas')->insert([
            'competencia_id' => Competencia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'fecha_competencia' => $faker->dateTimeBetween('now', '+5 month'),
            'ubicacion' => $faker->city,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}           
