<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'station' => $this->whenLoaded('station', StationResource::make($this->station)),
            'district' => $this->whenLoaded('district', DistrictResource::make($this->district)),
            'group' => $this->whenLoaded('group', GroupResource::make($this->group))
        ];
    }
}
