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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CursoacadTableSeeder::class);
        $this->call(TitulacionTableSeeder::class);
        $this->call(CriterioevaluacionTableSeeder::class);
        $this->call(InstitucionTableSeeder::class);
    }
}
