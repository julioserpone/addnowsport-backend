<?php

use App\Modelos\Usuario;
use App\Modelos\DatosBancarios;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StoresTableSeeder extends Seeder
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
        DB::table('stores')->insert([
            'datos_banco_id' => DatosBancarios::select(['id'])->orderByRaw('RAND()')->first()->id,
            'usuario_id' => Usuario::select(['id'])->where('nombre','<>','Administrador')->orderByRaw('RAND()')->first()->id,
            'rut' => $faker->swiftBicNumber,
            'razon_social' => $faker->catchPhrase,
            'giro' => $faker->word,
            'correo' => $faker->email,
            'nombre' => $faker->company,
            'direccion' => $faker->address,
            'pais' => $faker->country,
            'telefono' => $faker->phoneNumber,
            'ciudad' => $faker->city,
            'celular' => $faker->phoneNumber,
            'pin_retiro' => $faker->randomNumber($nbDigits = 4),
            'prefix' => $faker->word,
            'slug' => $faker->word,
            'monto_disponible' => $faker->numberBetween($min = 100, $max = 1000),
            'comision' => $faker->numberBetween($min = 100, $max = 1000),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }
    }
}
