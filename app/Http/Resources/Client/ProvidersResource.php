<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\CategoryResource;
use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
                'categories'=> CategoryResource::collection($this->categories),
                'description'=> $this->{"description_".accept_language()},
                'advantages'=> $this->{"advantages_".accept_language()},
                'rate'=> ($this->rate)?? round(Rate::where('provider_id',$this->id)->avg('value'),1),
                'my_rate'=> Auth::guard('api')->user() ? Rate::where(['provider_id'=>$this->id, 'client_id' => Auth::guard('api')->user()->id])->first()?? null : null
        ];
    }
}
