<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    protected $fillable = [
        'order_id','product_id','variant_id','quantity','price','color','size','color_id','size_id'
    ];

    protected $table = 'order_items';

    public function Order(){
      return $this->belongsTo(Order::class);
    }

    public function ColorValue(){
      return $this->belongsTo(Attributevalue::class,'color_id');
    }

    public function SizeValue(){
      return $this->belongsTo(AttributeValue::class,'size_id');
    }

    public function attributeValues(){
      return $this->hasMany(OrderItemAttributeValue::class,'order_item_id');                                                                                
    }
}
