<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvidersResource extends JsonResource
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
                'name'=>$this->name,
                'phone'=>$this->phone,
                'email'=>$this->email,
                'image'=>$this->image,
                'categories'=> CategoryResource::collection($this->categories)
        ];
    }
}
