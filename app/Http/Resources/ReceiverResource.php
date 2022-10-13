<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ReceiverResource extends JsonResource
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
            'group' => $this->whenLoaded('group', GroupResource::make($this->group)),
            'receiver_type' => $this->receiver_type,
            'national_identity_number' => $this->national_identity_number,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'profession' => $this->profesession,
            'province' => $this->province,
            'regency' => $this->regency,
            'district' => $this->district,
            'village' => $this->village,
            'address' => $this->address,
            'status' => $this->status,
            'barcode' => $this->barcode,
            'created_at' => $this->created_at,
            'submissions' => $this->whenLoaded('submission_receivers', SubmissionReceiverResource::collection($this->submission_receivers))
        ];

    }
}
