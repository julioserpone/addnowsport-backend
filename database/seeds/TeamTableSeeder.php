<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TeamTableSeeder extends Seeder
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
        DB::table('teams')->insert([
            'nombre' => $faker->unique()->word,
            'estatus' => $faker->randomElement(array_keys(trans('tipos.estatus'))),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }
    }
}
