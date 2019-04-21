<?php
use App\Modelos\Usuario;
use App\Modelos\DistanciaCategoria;
use App\Modelos\Competencia;
use App\Modelos\Movimiento;
use App\Modelos\TeamUsuario;
use App\Modelos\Productora;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InscriptosTableSeeder extends Seeder
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
        DB::table('inscriptos')->insert([
            'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
            'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
            'competencia_id' => Competencia::select(['id'])->orderByRaw('RAND()')->first()->id,
            'distancia_categoria_id' => DistanciaCategoria::select(['id'])->orderByRaw('RAND()')->first()->id,
            'movimiento_id' => Movimiento::select(['id'])->orderByRaw('RAND()')->first()->id,
            'team_usuario_id' => TeamUsuario::select(['id'])->orderByRaw('RAND()')->first()->id,
            'fecha' => $faker->dateTime($max = 'now'),
      		  'nro_corredor' => $faker->numberBetween($min = 11111, $max = 99999),
      		  'tiempo_1' => $faker->time($format = 'H:i:s', $max = 'now'),
              'tiempo_2' => $faker->time($format = 'H:i:s', $max = 'now'),
              'tiempo_3' => $faker->time($format = 'H:i:s', $max = 'now'),
              'tiempo_4' => $faker->time($format = 'H:i:s', $max = 'now'),
              'tiempo_t' => $faker->time($format = 'H:i:s', $max = 'now'),
      		  'posicion' => $faker->numberBetween($min = 1, $max = 10),
      		  'genero' => $faker->randomElement(array_keys(trans('tipos.generos'))),
      		  'edad' => $faker->numberBetween($min = 10, $max = 40),
      		  'pais' => $faker->country,
      		  'status' => $faker->randomElement(array_keys(trans('tipos.estatus_inscripcion'))),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }
    }
}
