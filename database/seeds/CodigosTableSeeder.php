<?php
use App\Modelos\Productora;
use App\Modelos\Competencia;
use App\Modelos\Fecha;
use App\Modelos\Usuario;
use App\Modelos\Codigo;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;

class CodigosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1,20) as $index) {
        $tipo = $faker->randomElement(array_keys(trans('tipos.descuentos')));
        $porcentaje = ($tipo == 'free') ? 100 : $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 50);
        DB::table('codigos')->insert([
            'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
            'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
            'tipo' => $tipo,
            'codigo' =>$faker->unique()->isbn10,
            'fecha_inicio' => $faker->dateTime($max = 'now'),
            'fecha_vencimiento' => $faker->dateTimeBetween('now', '+5 month'),
            'limite_uso_cupon' => $faker->numberBetween($min = 1, $max = 20),
            'limite_uso_usuario' => $faker->numberBetween($min = 1, $max = 5),
            'porcentaje_descuento' => $porcentaje,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
        ]);
      }

      $codigos = Codigo::all();
      foreach ($codigos as $codigo) {
        $competencias = Competencia::select(['id','costo_individual'])->where('productora_id', $codigo->productora_id)->get();
        foreach ($competencias as $competencia) {
          DB::table('codigo_competencia')->insert([
            'codigo_id' => $codigo->id,
            'competencia_id' => $competencia->id,
            'valor_descuento' => ($competencia->costo_individual * $codigo->porcentaje_descuento) / 100,
            'valor_a_pagar' => $competencia->costo_individual - (($competencia->costo_individual * $codigo->porcentaje_descuento) / 100),
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),            
          ]);
        }
      }
    }
}
