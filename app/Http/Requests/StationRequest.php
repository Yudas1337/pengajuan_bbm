<?php

namespace App\Http\Requests;

use App\Rules\StationRule;

class StationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'district_id' => 'required',
            'name' => 'required|min:3|max:150',
            'number' => 'required|max:50',
            'address' => 'required',
            'pic_name' => 'required|regex:/^[a-z-A-Z_\s\.]*$/',
            'pic_phone' => 'required|regex:/^[0-9]*$/',
            'type' => ['required', new StationRule()]
        ];
    }
}
