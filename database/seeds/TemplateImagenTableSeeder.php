<?php
use App\Modelos\TemplateSlider;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TemplateImagenTableSeeder extends Seeder
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
            DB::table('template_imagenes')->insert([
                'templateSlider_id' => TemplateSlider::select(['id'])->orderByRaw('RAND()')->first()->id,
                'imagen' => $faker->imageUrl(),
                'titulo' => $faker->word,
                'boton' => $faker->boolean(50),
                'nombre_boton' => $faker->word,
                'vinculo_boton' => $faker->imageUrl(),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),            
            ]);
        }
    }
}  
