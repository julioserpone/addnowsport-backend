<?php
use App\Modelos\Usuario;
use App\Modelos\Imagen;
use App\Modelos\Productora;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductorasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $usuarios = Usuario::select(['id'])->where('nombre','Administradora');

      foreach (range(1,15) as $index) {
        DB::table('productoras')->insert([
            'usuario_id' => $usuarios->orderByRaw('RAND()')->first()->id,
            'cuit' => $faker->swiftBicNumber,
            'rut' => $faker->swiftBicNumber,
            'giro' => $faker->word,
            'nombre' => $faker->company,
            'pais' => $faker->countryCode,
            'provincia' => $faker->country,
            'ciudad' => $faker->city,
            'razon_social' => $faker->catchPhrase,            
            'correo' => $faker->email,            
            'direccion' => $faker->address,
            'prefijo_t' => $faker->numberBetween(1000),
            'telefono' => $faker->phoneNumber,
            'prefijo_c' => $faker->numberBetween(1000),
            'celular' => $faker->phoneNumber,            
            'pin_retiro' => $faker->randomNumber($nbDigits = 4),
            'descripcion' => $faker->word,            
            'slug' => $faker->word,
            'facebook' => $faker->word,
            'twitter' => $faker->word,
            'google' => $faker->word,           
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }

      $usuarios = Usuario::where('nombre','Productora')->get();
      foreach ($usuarios as $usuario) {
        $usuario->productora_activa = Productora::select(['id'])->orderByRaw('RAND()')->first()->id;
        $usuario->save();
      }
    }
}
