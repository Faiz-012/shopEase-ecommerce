<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    \App\Models\Tag::insert([
        ['name' => 'Red', 'slug' => 'red', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Blue', 'slug' => 'blue', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Full Sleeves', 'slug' => 'full-sleeves', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Half Sleeves', 'slug' => 'half-sleeves', 'created_at' => now(), 'updated_at' => now()],
    ]);
}

}
