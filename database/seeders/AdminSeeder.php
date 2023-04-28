<?php
namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_seeds = [
            ['id' => '1', 'fullName' => 'Admin', 'email' => 'admin@root.com'
                , 'address' => '12', 'password' => Hash::make('password'), 'idNo' => '1234567890', 'role' => 'Admin'],

        ];

        foreach ($admin_seeds as $admin_seed) {
            User::firstOrCreate($admin_seed);

        }
    }
}
