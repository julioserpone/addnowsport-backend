<?php

use Illuminate\Database\Seeder;
use App\Modelos\Productora;
use App\Modelos\Competencia;
use App\Modelos\Imagen;
use Faker\Factory as Faker;

class PremiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1,20) as $index) {
        DB::table('premios')->insert([
            'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
            'competencia_id' => Competencia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'imagen_id' => Imagen::select(['id'])->orderByRaw('RAND()')->first()->id,
            'fecha' => $faker->dateTime($max = 'now'),
            'nombre' => $faker->word,
            'descripcion' => $faker->text($maxNbChars = 250),
            'puesto' => $faker->numberBetween($min = 1, $max = 10),
            'monto' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}
