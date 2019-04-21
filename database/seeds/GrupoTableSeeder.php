<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Productora;

class GrupoTableSeeder extends Seeder
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
        DB::table('grupos')->insert([
            'nombre' => $faker->unique()->word,
            'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
            'status' => $faker->randomElement(array_keys(trans('tipos.estatus'))),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }
    }
}
