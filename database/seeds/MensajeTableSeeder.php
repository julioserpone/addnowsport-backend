<?php

use Illuminate\Database\Seeder;

class MensajeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Modelos\Mensaje::class, 50)->create();
    }
}
