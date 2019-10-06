<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ClienteTableSeeder::class);
        $this->call(SerieTableSeeder::class);
    }
}
