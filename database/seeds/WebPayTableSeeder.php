<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Movimiento;

class WebPayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,5) as $index)
        {
            DB::table('webpay')->insert([
                'orden_compra' => 'OC_' . $faker->numberBetween($min = 100, $max = 50000),
                'tipo_transaccion' => $faker->numberBetween($min = 1, $max = 10),
                'monto' => $faker->randomFloat(1000,100000),
                'id_sesion' => $faker->numberBetween($min = 100000, $max = 10000000),
                'tipo_pago' => $faker->numberBetween($min = 1, $max = 10),
                'numero_cuotas' => $faker->numberBetween($min = 1, $max = 10),
                'fecha_transaccion' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
                'hora_transaccion' =>$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
                'fecha_contable' => $faker->numberBetween($min = 1000, $max = 10000),
                'codigo_autorizacion' => $faker->numberBetween($min = 1000, $max = 10000),
                'id_transaccion' => $faker->city,
                'final_numero_tarjeta' => $faker->phoneNumber,
                'movimiento_id' => Movimiento::select(['id'])->orderByRaw('RAND()')->first()->id,
                'status' => $faker->randomNumber($nbDigits = 4),
                'created_at' => $faker->dateTime($startDate = '-5 years', $max = 'now'),
                'updated_at' => $faker->dateTime($startDate = '-5 years', $max = 'now'),
            ]);
        }
    }
}
