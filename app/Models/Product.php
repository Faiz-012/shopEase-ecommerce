<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
    
{
    public function Seller(){
        return $this->belongsTo(Seller::class);
    }
}
