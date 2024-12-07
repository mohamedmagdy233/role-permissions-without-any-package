<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {
        $image = null;

        if ($this->image != null) {
            $image = asset('storage/'.$this->image);
        }

        return [

            'id' => $this->id,
            'name' => $this->name,
            'image' =>$image,

        ];
    }
}
