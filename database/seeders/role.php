<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name'=>'Administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name'=>'Author',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name'=>'Contributor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name'=>'Editor',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
