<?php

use App\Rol;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Rol::all();

        foreach ($roles as $rol){
            
            if(strcmp (strtoupper($rol->nombre), User::USUARIO_ADMINISTRADOR )==0)
            {
                $this->rolId = $rol->id;
                break;
            }
        }

        User::create([
            'nombres' => "admin",
            'apellidos' => "admin",
            'dpi' => "0000000000000",
            'direccion' => "Ciudad",
            'telefono' => "00000000",
            'email' => "admin@gmail.com",
            'password' => bcrypt('12345'),
            'rol_id' => $this->rolId
        ]);
    }
}
