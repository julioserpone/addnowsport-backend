<?php

use App\Modelos\Distancia;
use App\Modelos\Categoria;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DistanciaCategoriasTableSeeder extends Seeder
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
        DB::table('distancia_categorias')->insert([
            'distancia_id' => Distancia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'categoria_id' => Categoria::select(['id'])->orderByRaw('RAND()')->first()->id,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}           
