<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert specific users
        DB::table('users')->insertOrIgnore([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'admin' => true,
                'password' => Hash::make('admin1234'),      // Use a secure password!
                'created_at' => now(),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane.doe@example.com',
                'admin' => false,
                'password' => Hash::make('user1234'),       // Use a secure password!
                'created_at' => now(),
                'email_verified_at' => now()
            ]
        ]);

        // Generate 40 additional users
        for ($i = 1; $i <= 40; $i++) {
            // Example: every 6th user is inactive
            $isActive = ($i % 6 !== 0);
            $users[] = [
                'name' => "ITF User $i",
                'email' => "itf_user_$i@mailinator.com",
                'password' => Hash::make("itfuser$i"),
                'active' => $isActive,
                'created_at' => now(),
                'email_verified_at' => now()
            ];
        }

        // Perform a batch insert
        DB::table('users')->insertOrIgnore($users);
    }
}
