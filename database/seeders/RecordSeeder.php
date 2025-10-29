<?php

namespace Database\Seeders;


use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the table first
        DB::table('records')->delete();

        // Insert records - THIS IS ONLY A SAMPLE! COPY FROM GIST!
        DB::table('records')->insert(
            [
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Queen',
                    'title' => 'Greatest Hits',
                    'mb_id' => 'fcb78d0d-8067-4b93-ae58-1e4347e20216',
                    'price' => 19.99
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Michael Jackson',
                    'title' => 'Thriller',
                    'mb_id' => 'fcb78d0d-8067-4b93-ae58-1e4347e20216',
                    'price' => 19.99
                ],
                // ... Add ALL other records from the Gist here ...
            ]);
    }
}
