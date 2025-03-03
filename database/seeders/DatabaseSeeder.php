<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // call out the seeder file name

        $this->call([
            AdminUsersSeeder::class,
        ]);
    }
}
// Update this to call our new created seeder which is the AdminUsersSeeder.php