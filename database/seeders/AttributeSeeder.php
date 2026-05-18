<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Attribute 1 color 
        $color = Attribute::create(['name' => 'color']);
        AttributeValue::insert([
            ['attribute_id' => $color->id, 'value' => 'silverBlack'],
            ['attribute_id' => $color->id, 'value' => 'silver']
        ]);

        $size = Attribute::create(['name' => 'Size']);
        AttributeValue::insert([
            ['attribute_id' => $size->id, 'value' => 'Onesize']
        ]);
    }
}
