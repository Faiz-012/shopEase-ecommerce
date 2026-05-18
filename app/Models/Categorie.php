<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['name','slug'];

    public function products(){
        return $this->belongsToMany(Item::class,'category_product','category_id', 'product_id');
    }
}
