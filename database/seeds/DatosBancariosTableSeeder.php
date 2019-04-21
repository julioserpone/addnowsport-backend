<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Bancos;

class DatosBancariosTableSeeder extends Seeder
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
        DB::table('datos_bancarios')->insert([
            'banco_id' => Bancos::select(['id'])->orderByRaw('RAND()')->first()->id,
            'tipo_cuenta' => $faker->randomElement(array_keys(trans('tipos.cuentas'))),
            'titular' => $faker->name,
            'rut' => $faker->swiftBicNumber,
            'nro_cuenta' => $faker->creditCardNumber,
            'banco' => $faker->company,
            'correo' => $faker->email,
            'valida' => $faker->boolean(50),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
      }
    }
}
