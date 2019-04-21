<?php

use Illuminate\Database\Seeder;
use App\Modelos\Codigo;
use App\Modelos\Usuario;
use App\Modelos\Productora;
use App\Modelos\Competencia;
use Faker\Factory as Faker;

class CodigoUsadoSeeder extends Seeder
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
        DB::table('codigo_usados')->insert([
            'codigo_id' => Codigo::select(['id'])->orderByRaw('RAND()')->first()->id,
            'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
            'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
            'competencia_id' => Competencia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}
