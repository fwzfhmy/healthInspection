<?php

use Database\Seeders\AdminSeeder;
use Database\Seeders\DaySeeder;
use Database\Seeders\SymptomSeeder;
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
        // $this->call(UserSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SymptomSeeder::class);
    }
}
