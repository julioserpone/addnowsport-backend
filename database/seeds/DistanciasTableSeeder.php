<?php
use App\Modelos\Productora;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DistanciasTableSeeder extends Seeder
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
            DB::table('distancias')->insert([
                'productora_id' => Productora::select(['id'])->orderByRaw('RAND()')->first()->id,
                'nombre' => $faker->word,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),            
            ]);
        }
    }
}  
