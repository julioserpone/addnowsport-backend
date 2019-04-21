<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Productora;

class CircuitosTableSeeder extends Seeder
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
        DB::table('circuitos')->insert([
            'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
            'nombre' => $faker->company,
            'puntos' => $faker->text(100),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }
    }
}
