<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Circuito;
use App\Modelos\Competencia;

class CircuitosCompetenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1,10) as $index) {
        DB::table('circuitos_competencias')->insert([
            'competencia_id' => Competencia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'circuito_id' => Circuito::select(['id'])->orderByRaw('RAND()')->first()->id,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }
    }
}
