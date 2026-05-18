<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seller extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
       

        DB::table('sellers')->insert([
        [
        'name'=> 'jasmin',
        'created_at' => now(),
        'updated_at' => now()
        ],
        [
            'name' => 'Sk Mobile',
            'created_at' => now(),
            'updated_at' => now()
        ]
            ]);
        }
}
