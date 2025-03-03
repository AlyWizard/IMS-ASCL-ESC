<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing users first to avoid duplicates
        DB::table('esc_users')->truncate();
        DB::table('alliance_users')->truncate();
        
        // Add ESC Admin user
        DB::table('esc_users')->insert([
            'username' => 'EscAdmin',
            'password' => Hash::make('AdminEsc'), // Correct password hash
            'email' => 'admin@esc.com',
            'name' => 'ESC Administrator',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add Alliance Admin user
        DB::table('alliance_users')->insert([
            'username' => 'AllianceAdmin',
            'password' => Hash::make('AdminAlliance'), // Correct password hash
            'email' => 'admin@alliance.com',
            'name' => 'Alliance Administrator',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

//Code for the default username and pass for the admin of both esc and alliance