<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ReceiverRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'submission_id' => 'nullable',
            'receiver_type' => 'required',
            'national_identity_number' => ['required', Rule::unique('receivers')->ignore($this->receiver)],
            'name' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'profession' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'address' => 'required',
            'status' => 'required',
            'valid_from' => 'required',
            'valid_until' => 'required'
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
            'receiver_type.required' => 'Tipe tidak boleh kosong!',
            'national_identity_number.required' => 'NIK tidak boleh kosong!',
            'national_identity_number.unique' => 'NIK sudah digunakan!',
            'name.required' => 'Nama tidak boleh kosong!',
            'phone_number.required' => 'Nomor telepon tidak boleh kosong!',
            'gender.required' => 'Jenis kelamin tidak boleh kosong!',
            'birth_place.required' => 'Tempat lahir tidak boleh kosong!',
            'birth_date.required' => 'Tanggal lahir tidak boleh kosong!',
            'profession.required' => 'Profesi tidak boleh kosong!',
            'province.required' => 'Provinsi tidak boleh kosong!',
            'regency.required' => 'Kabupaten / kota tidak boleh kosong!',
            'district.required' => 'Kecamatan tidak boleh kosong!',
            'village.required' => 'Desa / kelurahan tidak boleh kosong!',
            'address.required' => 'Alamat tidak boleh kosong!',
            'status.required' => 'Status tidak boleh kosong!',
            'valid_from.required' => 'Valid sejak tidak boleh kosong!',
            'valid_until.required' => 'Valid sampai tidak boleh kosong!'
        ];
    }
}
