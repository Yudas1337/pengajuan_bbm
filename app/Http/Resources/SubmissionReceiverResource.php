<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SubmissionReceiverResource extends JsonResource
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
            'quota' => $this->quota,
            'status' => $this->status,
            'validated_by' => $this->whenLoaded('user', UserResource::make($this->user)),
            'validated_at' => $this->validated_at,
            'created_at' => $this->created_at,
            'detail' => $this->whenLoaded('submission', SubmissionResource::make($this->submission))
        ];
    }
}
