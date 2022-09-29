<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseApiRequest\Api;

class LoginRequest extends BaseApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }
}
