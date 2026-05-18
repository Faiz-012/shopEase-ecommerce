<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemAttributeValue extends Model
{
    protected $table = 'order_item_attribute_values';
    
    protected $fillable = [
        'order_item_id','attribute_id','attribute_value_id'
    ];

    public function OrderItem(){
        return $this->belongsTo(Order_Item::class);
    }

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
    
    public function attributeValue(){
        return $this->belongsTo(AttributeValue::class,'attribute_value_id');
    }
}
