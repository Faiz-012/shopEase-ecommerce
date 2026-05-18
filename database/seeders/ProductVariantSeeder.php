<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Item;
use App\Models\ProductVariant;
use App\Models\ProductVariantValue;
use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Item::firstOrCreate(
            [ 'name' => 'Plain Shirt'],
            [
                'price' =>  599.00,
                'description' => 'White micro ditsy self design opaque Casual shirt ,has a spread collar, button placket, 1 patch pocket, long regular sleeves, curved hem', 
            ]
        );

        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'price' => '599.00', //variant specific price
            'stock' => 0,
        ]);

        // Find attribute values (Color = Red, Size = M)
        $Green = AttributeValue::where('value', 'Green')->first();

        ProductVariantValue::insert([
            ['variant_id' => $variant->id, 'attribute_value_id' => $Green->id],
        ]);
    }
}
