<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Item extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name','image','description','price'
    ];

    //Relation: Product ↔ Category (Many to Many).
    public function categories(){
        return $this->belongsToMany(Categorie::class,'category_product','product_id','category_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id');
    }

    public function images(){
        return $this->hasMany(Item_images::class,'item_id');
    }

    public function variant(){
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
