<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Usuario;
use App\Modelos\DatosBancarios;

class DatosBancariosUsuariosTableSeeder extends Seeder
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
        DB::table('datos_bancarios_productoras')->insert([
            'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
            'datosbancarios_id' => DatosBancarios::select(['id'])->orderByRaw('RAND()')->first()->id,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
      }
    }
}
