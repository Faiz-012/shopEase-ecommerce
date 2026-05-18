<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item_images extends Model
{
    protected $table = 'item_image';

    protected $fillable = [
        'id','item_id','images','color','created_at','updated_at'
    ];

    public function Item(){
        return $this->belongsTo(Item::class,'item_id');
    }
}
