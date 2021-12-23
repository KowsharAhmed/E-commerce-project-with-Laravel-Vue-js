<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];


    // Thats  called one to many relationship
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //   Or
    //   Thats  called one to one relationship
    // public function product(){
    //     return $this->hasOne(Product::class,'id','product_id');
    // }
}
