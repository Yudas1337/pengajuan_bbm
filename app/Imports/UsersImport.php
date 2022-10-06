<?php

namespace App\Imports;

use App\Models\Receiver;
use App\Models\SubmissionReceiver;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UsersImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return Model|null
     */

    public function model(array $row)
    {
        $old = Receiver::where('national_identity_number', $row['nik'])->first();

        if (!$old) {
            $image = QrCode::format('png')
                ->size(500)
                ->generate($row['nik']);
            $output_file = 'qr_file/' . $row['nik'] . '.png';
            Storage::disk('public')->put($output_file, $image);
        }

        $submission_id = request('submission_id');

        $receiver = Receiver::firstOrCreate(
            ['national_identity_number' => $row['nik'] ?? $row['nomor_kusuka']],
            [
                'id' => Uuid::uuid(),
                'receiver_type' => $row['tipe'],
                'national_identity_number' => $row['nik'] ?? $row['nomor_kusuka'],
                'name' => $row['nama'],
                'gender' => ($row['jenis_kelamin'] === '-') ? null : $row['jenis_kelamin'],
                'birth_place' => $row['tempat_lahir'],
                'birth_date' => ($row['tanggal_lahir'] === '-') ? null : $row['tanggal_lahir'],
                'profession' => $row['profesi_utama'],
                'province' => $row['provinsi'],
                'regency' => $row['kabupatenkota'],
                'district' => $row['kecamatan'],
                'village' => $row['desa'],
                'address' => $row['alamat'],
                'status' => $row['status'],
                'valid_from' => Carbon::parse($row['valid_from'])->format('Y-m-d'),
                'valid_until' => Carbon::parse($row['valid_until'])->format('Y-m-d'),
                'barcode' => $output_file ?? null
            ]
        );

        SubmissionReceiver::updateOrCreate(
            ['submission_id' => $submission_id, 'receiver_id' => $receiver['id']],
            [
                'id' => Uuid::uuid(),
                'receiver_id' => $receiver['id'],
                'submission_id' => $submission_id
            ]
        );
    }

    public function headingRow(): int
    {
        return 4;
    }

    public function batchSize(): int
    {
        return 2000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
