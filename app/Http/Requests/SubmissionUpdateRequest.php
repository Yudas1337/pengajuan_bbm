<?php

namespace App\Http\Requests;

class SubmissionUpdateRequest extends BaseRequest
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
            'group_id' => 'required',
            'group_leader' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'station_id' => 'required',
            'receiver_type' => 'required',
            'letter_file' => 'nullable|mimes:pdf,jpeg|max:5120|file',
            'approval_message' => 'nullable',
            'note'      => 'nullable',
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
            'group_id.required' => 'Nama Kelompok tidak boleh kosong',
            'group_name.required' => 'Nama Kelompok tidak boleh kosong',
            'group_leader.required' => 'Nama Ketua Kelompok tidak boleh kosong',
            'district_id.required' => 'Kecamatan tidak boleh kosong',
            'village_id.required' => 'Desa/Kelurahan tidak boleh kosong',
            'station_id.required' => 'SPBU tidak boleh kosong',
            'receiver_type.required' => 'Jenis penerima tidak boleh kosong',
            'letter_file.pdf' => 'Bukti Surat harus berekstensi pdf',
            'letter_file.max' => 'Bukti Surat maksimal 5Mb'
        ];
    }
}
