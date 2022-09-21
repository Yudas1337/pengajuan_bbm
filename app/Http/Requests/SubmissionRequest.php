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
            'letter_number' => 'required',
            'date' => 'required|date',
            'district_id' => 'required',
            'village_id' => 'required',
            'station_id' => 'required',
            'equipment_type' => 'required',
            'total_equipment' => 'required',
            'equipment_function' => 'required',
            'fuel_type' => 'required',
            'equipment_needed' => 'required',
            'equipment_uptime' => 'required',
            'time_unit' => 'required',
            'formula' => 'required',
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
            'letter_number.required' => 'Nomor Surat Pengajuan tidak boleh kosong',
            'date.required' => 'Tanggal tidak boleh kosong',
            'district_id.required' => 'Kecamatan tidak boleh kosong',
            'village_id.required' => 'Desa/Kelurahan tidak boleh kosong',
            'station_id.required' => 'SPBU tidak boleh kosong',
            'equipment_type.required' => 'Jenis Alat tidak boleh kosong',
            'total_equipment.required' => 'Jumlah Alat tidak boleh kosong',
            'equipment_function.required' => 'Fungsi Alat tidak boleh kosong',
            'fuel_type.required' => 'Jenis BBM tidak boleh kosong',
            'equipment_needed.required' => 'Kebutuhan Setiap Alat tidak boleh kosong',
            'equipment_uptime.required' => 'Waktu Operasional Alat tidak boleh kosong',
            'time_unit.required' => 'Satuan Waktu tidak boleh kosong',
            'formula.required' => 'Formula tidak boleh kosong',
            'letter_file.required' => 'Bukti Surat tidak boleh kosong',
            'letter_file.pdf' => 'Bukti Surat harus berekstensi pdf',
            'letter_file.max' => 'Bukti Surat maksimal 5Mb'
        ];
    }
}
