<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'price'=>$this->price,
            "detail"=> $this->detail,
            "price"=>$this->price,
            "category"=>$this->category,
            "type"=>json_decode($this->type),
            "color"=> $this->color,
            "image"=>$this->image,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            //"created_at"=> $this->created_at->format('Y-m-d H:i:s'),
            //"updated_at"=> $this->updated_at->format('Y-m-d H:i:s'),
            //"created_at"=> $this->created_at
//            "updated_at": "2022-03-10T10:32:22.000000Z"
        ];
    }
}
