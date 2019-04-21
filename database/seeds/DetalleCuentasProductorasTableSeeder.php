<?php
use App\Modelos\DatosBancarios;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DetalleCuentasProductorasTableSeeder extends Seeder
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
        DB::table('detalle_cuenta_productoras')->insert([
            'cuenta_id' => DatosBancarios::select(['id'])->orderByRaw('RAND()')->first()->id,
            'tipo_movimiento' => $faker->randomElement(array_keys(trans('tipos.movimientos'))),
            'cantidad' => $faker->numberBetween($min = 1, $max = 100),           
            'valor' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500),
            'detalle' => $faker->word,
            'sub_total' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}
