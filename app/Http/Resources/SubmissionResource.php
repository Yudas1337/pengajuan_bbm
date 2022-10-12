<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SubmissionResource extends JsonResource
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
            'station_id' => $this->whenLoaded('station', StationResource::make($this->station)),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'created_by' => $this->created_by
        ];
    }
}
