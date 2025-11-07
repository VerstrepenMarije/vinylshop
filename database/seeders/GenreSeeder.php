<?php

namespace Database\Seeders;


use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the table first to avoid duplicates if seeder runs multiple times
        DB::table('genres')->truncate();

        // Insert genres
        DB::table('genres')->insert(
            [
                ['name' => 'pop/rock',      'created_at' => now()],
                ['name' => 'punk',          'created_at' => now()],
                ['name' => 'industrial',    'created_at' => now()],
                ['name' => 'hardrock',      'created_at' => now()],
                ['name' => 'new wave',      'created_at' => now()],
                ['name' => 'dance',         'created_at' => now()],
                ['name' => 'reggae',        'created_at' => now()],
                ['name' => 'jazz',          'created_at' => now()],
                ['name' => 'dubstep',       'created_at' => now()],
                ['name' => 'blues',         'created_at' => now()],
                ['name' => 'indie rock',    'created_at' => now()],
                ['name' => 'noise',         'created_at' => now()],
                ['name' => 'electro',       'created_at' => now()],
                ['name' => 'techno',        'created_at' => now()],
                ['name' => 'folk',          'created_at' => now()],
                ['name' => 'hip hop',       'created_at' => now()],
                ['name' => 'soul',          'created_at' => now()],
            ]
        );
    }
}
