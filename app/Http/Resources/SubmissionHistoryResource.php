<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SubmissionHistoryResource extends JsonResource
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
            'submission_receiver_id' => $this->submission_receiver_id,
            'quota_cost' => $this->quota_cost,
            'user' => $this->whenLoaded('user', UserResource::make($this->user)),
            'created_at' => $this->created_at
        ];
    }
}
