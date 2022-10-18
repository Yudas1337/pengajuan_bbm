<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'group_name'    => ['required', 'max:150', Rule::unique('groups')->ignore($this->group)],
            'group_leader_id'  => 'required|exists:users,id',
            'receiver_type' => 'required'
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
            'group_name.required' => 'Nama group tidak boleh kosong!',
            'group_name.unique' => 'Nama group telah digunakan!',
            'group_name.max' => 'Nama group terlalu panjang!',
            'group_leader_id.required' => 'Ketua kelompok tidak boleh kosong!',
            'group_leader_id.exists' => 'Ketua kelompok tidak ditemukan!',
            'receiver_type.required' => 'Jenis penerima tidak boleh kosong!'
        ];
    }
}
