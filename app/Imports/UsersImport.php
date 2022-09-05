<?php

namespace App\Imports;

use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use UserStatusEnum;

class UsersImport implements ToModel
{
    /**
     * @param array $r 'id
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
}
