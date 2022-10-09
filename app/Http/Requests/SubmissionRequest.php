<?php

namespace App\Http\Requests;

class SubmissionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'submission_id' => 'required',
            'group_name' => 'required',
            'group_leader' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'station_id' => 'required',
            'receiver_type' => 'required',
            'letter_file' => 'required|mimes:pdf,jpeg|max:5120|file',
            'start_time' => 'nullable',
            'end_time' => 'nullable'
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
            'group_name.required' => 'Nama Kelompok tidak boleh kosong',
            'group_leader.required' => 'Nama Ketua Kelompok tidak boleh kosong',
            'district_id.required' => 'Kecamatan tidak boleh kosong',
            'village_id.required' => 'Desa/Kelurahan tidak boleh kosong',
            'station_id.required' => 'SPBU tidak boleh kosong',
            'receiver_type.required' => 'Jenis Penerima tidak boleh kosong',
            'letter_file.required' => 'Bukti Surat tidak boleh kosong',
            'letter_file.pdf' => 'Bukti Surat harus berekstensi pdf',
            'letter_file.max' => 'Bukti Surat maksimal 5Mb'
        ];
    }
}
