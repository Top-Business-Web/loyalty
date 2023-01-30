<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResources;
use App\Http\Resources\OrderDetailsResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'total_price'=>$this->total_price,
            'note'=>$this->note,
            'user_data'=> User::select('name','phone')->find($this->user->id),
            'order_details'=> OrderDetailsResource::collection($this->details),
        ];
    }
}
