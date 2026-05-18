<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','payment_id','name','email','phone','address','city','pincode','country','payment_method','total','status'
    ];
    protected $table = 'orders';

    public function items(){
        return $this->hasMany(Order_Item::class);
    }
}
