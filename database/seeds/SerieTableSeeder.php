<?php

use App\Serie;
use Illuminate\Database\Seeder;

class SerieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Serie::create([
            'nombre' => "A"
        ]);

        Serie::create([
            'nombre' => "B"
        ]);

    }
}
