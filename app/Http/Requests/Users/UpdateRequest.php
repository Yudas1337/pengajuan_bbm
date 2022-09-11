<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|regex:/^[a-z-A-Z_\s\.]*$/',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'station_id' => 'nullable|exists:stations,id',
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($this->user)],
            'roles' => 'required'
        ];
    }
}
