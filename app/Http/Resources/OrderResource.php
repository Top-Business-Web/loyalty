<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResources;
use App\Http\Resources\OrderDetailsResource;
use App\Models\User;
use Carbon\Carbon;
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
            'user_data'=> User::select('id','name','phone_code','phone')->find($this->user->id),
            'provider_data'=> User::select('id','name','phone_code','phone')->find($this->provider->id),
            'order_details'=> OrderDetailsResource::collection($this->details),
            'data_time'=> $this->created_at->format('d/m/Y h:m'),
        ];
    }
}
