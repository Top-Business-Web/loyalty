<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $all = parent::toArray($request);
        $all['is_favorite'] = $this->is_favorite;
        $all['unit_details'] = $this->unit_details;
        return $all;
    }
}
