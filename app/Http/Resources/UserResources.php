<?php

namespace App\Http\Resources;

use App\Models\Cities;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
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
            'user'=>[
                'id'=>$this->id,
                'name'=>$this->name,
                'phone_code'=>$this->phone_code,
                'phone'=>$this->phone,
                'email'=>$this->email,
                'location'=>$this->location,
                'status'=>$this->status,
                'image'=>$this->image,
                'user_type'=>$this->role_id,
                'balance'=>$this->balance,
            ],
            'access_token'=>'Bearer '.$this->token??'',
            'token_type'=>'bearer'
        ];
    }
}
