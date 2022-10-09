<?php

namespace App\Http\Requests;

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
            'group_name'    => 'required|unique:groups|max:150',
            'group_leader_id'  => 'required|exists:users,id'
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
        ];
    }
}
