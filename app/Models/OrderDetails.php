<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function mainCategory(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subCategory(){
        return $this->belongsTo(Category::class,'sub_category_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
