<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'title',
        'description',
        'image'
    ];

    public function getImageAttribute()
    {
        return get_file($this->attributes['image']);
    }
}
