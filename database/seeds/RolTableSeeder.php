<?php

use App\Rol;
use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'nombre' => "Administrador"
        ]);

        Rol::create([
            'nombre' => "Digitador"
        ]);

        Rol::create([
            'nombre' => "Vendedor"
        ]);
    }
}
