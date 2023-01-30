<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(OrderDetails::class,'order_id');
    }//end fun


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }//end fun
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Admin::class,'provider_id');
    }//end fun
}
