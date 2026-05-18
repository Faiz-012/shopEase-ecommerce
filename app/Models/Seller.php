<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    function ProductData()
    {
        return $this->hasOne('App\Models\Product');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
