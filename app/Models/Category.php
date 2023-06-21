<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name_ar',
        'name_en',
        'image',
    ];

    ##  Mutators and Accessors
    public function getImageAttribute()
    {
        return get_file($this->attributes['image']);
    }


    /**
     * this function Relationship between table Category and User by the column user_id in table category
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
