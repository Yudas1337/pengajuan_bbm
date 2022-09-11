<?php

namespace App\Imports;

use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new User([
            'id' => Uuid::uuid(),
            'station_id' => $row[''] ?? null,
            'name' => $row['name'],
            'username' => $row['username'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'status' => UserStatusEnum::USER_ACTIVE->value
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
