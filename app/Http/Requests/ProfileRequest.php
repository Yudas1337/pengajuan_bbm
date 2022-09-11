<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|regex:/^[a-z-A-Z_\s\.]*$/',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($this->user->id)]
        ];
    }

    /**
     * Validation custom Messages.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'name.regex' => 'Nama harus berupa huruf',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email telah terdafar',
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal 3 karakter',
            'username.max' => 'Username maksimal 255 karakter',
            'username.unique' => 'Username telah terdaftar'
        ];
    }
}
