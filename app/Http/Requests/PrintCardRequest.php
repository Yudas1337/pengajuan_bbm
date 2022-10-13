<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintCardRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'nik'   => 'required'
        ];
    }

    /**
     * custom messages
     * 
     * @return array
     */
    public function messages() : array
    {
        return [
            'nik.required'  => 'NIK tidak boleh kosong!'
        ];
    }
}
