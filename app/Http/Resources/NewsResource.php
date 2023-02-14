<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        //this referes to Model associated With Resource 'News'
        return [
            'id'=> $this->id,
            'title'=>$this->title,
            'body'=>$this->description,
            'time'=>$this->created_at,
            'brought_By'=>new UserResource($this->news_owner)

        ];
    }
}
