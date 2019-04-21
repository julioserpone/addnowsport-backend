<?php

use App\Modelos\Usuario;
use App\Modelos\Team;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TeamUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 15) as $index) {
            DB::table('team_usuario')->insert([
                'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
                'team_id' => Team::select(['id'])->orderByRaw('RAND()')->first()->id,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}           
