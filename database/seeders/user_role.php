<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_role')->insert([
            

            [
            'user_id' => 2,
            'role_id' => 3
            ],

             [
            'user_id' => 3,
            'role_id' => 2
            ],
        ]);
    }
}
