<?php

use App\Cliente;
use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'nombres' => "Clientes",
            'apellidos' => "varios",
            'nit' => "C / F",
            'direccion' => "Ciudad",
        ]);
    }
}
