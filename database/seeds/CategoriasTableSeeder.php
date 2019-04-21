<?php
use App\Modelos\Productora;
use App\Modelos\Grupo;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
        foreach (range(1,50) as $index) {
          DB::table('categorias')->insert([
              'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
              'grupo_id' => Grupo::select(['id'])->orderByRaw('RAND()')->first()->id,
              'nombre' => $faker->word,
              'edad_inicio' => $faker->numberBetween($min = 10, $max = 15),
              'edad_final' => $faker->numberBetween($min = 30, $max = 40),
              'created_at' => $faker->dateTime($max = 'now'),
              'updated_at' => $faker->dateTime($max = 'now'),            
          ]);
      }
    }
}           
