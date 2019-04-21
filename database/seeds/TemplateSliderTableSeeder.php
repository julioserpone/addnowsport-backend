<?php
use App\Modelos\Usuario;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TemplateSliderTableSeeder extends Seeder
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
            DB::table('template_sliders')->insert([
                'usuario_id' => Usuario::select(['id'])->orderByRaw('RAND()')->first()->id,
                'tipo' => trans('tipos.slider')['home'],
                'total' => $faker->numberBetween(1,10),
                'efecto' => $faker->numberBetween(1,3),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),            
            ]);
        }
    }
}  
