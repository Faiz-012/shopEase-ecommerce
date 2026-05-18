<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
class users extends Seeder
{
  /**
   * Run the database seeds.
   */
   public function run()
    {
          DB::table('users')->where('name', 'faizan')->update([
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->where('name', 'programmer')->update([
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->where('name', 'IronMan')->update([
            'password' => Hash::make('123'),
        ]);

    }
}
