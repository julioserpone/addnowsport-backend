<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DisciplinasTableSeeder extends Seeder
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
        DB::table('disciplinas')->insert([
            'nombre' => $faker->word,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}           
