<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function Item(){
        return $this->belongsTo(Item::class, 'product_id');
    }
    
    public function variantValues(){
        return $this->hasMany(ProductVariantValue::class, 'variant_id');
    }
}
