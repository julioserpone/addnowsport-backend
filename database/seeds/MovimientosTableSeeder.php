<?php

use App\Modelos\Usuario;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MovimientosTableSeeder extends Seeder
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
        DB::table('movimientos')->insert([
          'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
        	'tipo' => $faker->randomElement(array_keys(trans('tipos.movimientos'))),
          'origen_transaccion' => $faker->randomElement(array_keys(trans('tipos.origen_transaccion'))),
          'nro' => $faker->creditCardNumber,
          'fecha' => date($format = 'Y-m-d'),
          'monto' => $faker->numberBetween($min = 1, $max = 1000),
          'comprobante' => $faker->word,
          'created_at' => DB::raw('CURRENT_TIMESTAMP'),
          'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
      }
    }
}
