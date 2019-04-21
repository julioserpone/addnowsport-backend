<?php

use App\Modelos\Usuario;
use App\Modelos\Movimiento;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SaldoUsuarioTableSeeder extends Seeder
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
        DB::table('saldo_usuarios')->insert([
            'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
            'movimiento_id' => Movimiento::select(['id'])->orderByRaw('RAND()')->first()->id,
            'saldo' => $faker->randomFloat(2, 0.0, 1000.0),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}           
