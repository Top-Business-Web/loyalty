<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\BasicUserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'id' =>$this->id,
            'from_user_id'=>$this->from_user_id,
            'to_user_id'=>$this->to_user_id,
            'post_id'=>$this->post_id,
            'project_id'=>$this->project_id,
            'from_user'=>new BasicUserResource(User::find($this->from_user_id)),
            'to_user'=>new BasicUserResource(User::find($this->to_user_id)),
            'date'=>date('Y-m-d',strtotime($this->created_at)),
            'time'=>date('h:i A',strtotime($this->created_at)),
        ];
    }
}
