<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'name_ar',
        'name_en',
        'price',
        'price_after_discount',
        'the_best',
        'image',
    ];



    public function getImageAttribute()
    {
        return get_file($this->attributes['image']);
    }

     /**
     * this function Relationship between table Product and User by the column user_id in table Product
     */
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
}
