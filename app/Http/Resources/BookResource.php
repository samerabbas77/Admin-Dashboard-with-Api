<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array = array(
            "id"               => $this->id,
            "name"             =>$this->name,
            "Main Category"    =>$this->gategory->name,
        	"Sub Category"     =>$this->subGategory->name,
        	"Publisher Name"   =>$this->publisher_name,
        	"Publish Date"     =>$this->publish_date
        );
        return $array;
    }
}
