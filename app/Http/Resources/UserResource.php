<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {

        $image = null;
        if ($this->image != null) {
            $image = asset('storage/'.$this->image);
        }
        return[
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $image,
            'location' => $this->location,
            'token' =>  $request->header('Authorization')?? 'Bearer '.$this->token,
        ];
    }
}
