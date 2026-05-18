<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   protected $fillable = ['user_id','product_id','variant_id','color','size','quantity','image'];

    public function product(){
        return $this->belongsTo(Item::class,'product_id');   
        // i think last me item_id rhega..
    }
    public function variant(){
        return $this->belongsTo(ProductVariant::class,'variant_id');
    }
}
