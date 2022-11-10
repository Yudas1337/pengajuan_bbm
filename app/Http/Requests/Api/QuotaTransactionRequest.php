<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;
use App\Rules\StationRule;

class QuotaTransactionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'submission_id' => 'required|exists:submissions,id',
            'quota_cost' => 'required|regex:/^[0-9]*$/',
            'receiver_id' => 'required|exists:receivers,id',
            'type' => ['required', new StationRule()]
        ];
    }
}
