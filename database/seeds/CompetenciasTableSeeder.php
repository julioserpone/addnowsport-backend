<?php
use App\Modelos\Productora;
use App\Modelos\Disciplina;
use App\Modelos\Imagen;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompetenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $productoras = Productora::select(['id'])->get();
      foreach ($productoras as $productora) {
        foreach (range(1,5) as $index) {
          DB::table('competencias')->insert([
              'productora_id' => $productora->id,
              'disciplina_id' => Disciplina::select(['id'])->orderByRaw('RAND()')->first()->id,
              'imagen_id' => Imagen::select(['id'])->orderByRaw('RAND()')->first()->id,
              'nombre' => $faker->word,
              'dominio' => $faker->word,
              'subdominio' => $faker->word,
              'costo' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500),
              'costo_individual' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500),
              'titulo' => $faker->word,
              'texto' => $faker->text($maxNbChars = 100),
              'subtitulado' => $faker->word,
              'descripcion' => $faker->text($maxNbChars = 100),
              'bases' => $faker->text($maxNbChars = 250),
              'cantidad_integrantes' => $faker->numberBetween(1,100),
              'facebook' => $faker->word,
              'twitter' => $faker->word,
              'google' => $faker->word,
              'estatus' => $faker->randomElement(array_keys(trans('tipos.estatus'))),
              'tipo' => $faker->randomElement(array_keys(trans('tipos.competencias'))),
              'created_at' => $faker->dateTime($max = 'now'),
              'updated_at' => $faker->dateTime($max = 'now'),             
          ]);
        }
      }
    }
}
