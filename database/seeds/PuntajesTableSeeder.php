<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Competencia;

class PuntajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1,100) as $index) {
        DB::table('puntajes')->insert([
            'puesto' => $faker->numberBetween(1,20),
            'puntos' => $faker->numberBetween(10,200),
            'competencia_id' => Competencia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
      }
    }
}
