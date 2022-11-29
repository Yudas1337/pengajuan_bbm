<?php

namespace App\Helpers;

use App\Enums\UserRoleEnum;

class UserHelper
{

    /**
     * check role ketua kelompok
     *
     * @return bool
     */

    public static function checkRoleKetuaKelompok(): bool
    {
        return auth()->user()->roles->pluck('name')[0] === UserRoleEnum::KETUA_KELOMPOK->value;
    }

    /**
     * check role penyuluh
     *
     * @return bool
     */

    public static function checkRolePenyuluh(): bool
    {
        return auth()->user()->roles->pluck('name')[0] === UserRoleEnum::PENYULUH->value;
    }

    /**
     * check role admin tangkap
     *
     * @return bool
     */

    public static function checkRoleTangkap(): bool
    {
        return auth()->user()->roles->pluck('name')[0] === UserRoleEnum::ADMIN_TANGKAP->value;
    }

    /**
     * check role admin pembudidaya
     *
     * @return bool
     */

    public static function checkRolePembudidaya(): bool
    {
        return auth()->user()->roles->pluck('name')[0] === UserRoleEnum::ADMIN_PEMBUDIDAYA->value;
    }

    /**
     * check role kepala dinas
     *
     * @return bool
     */

    public static function checkRoleKepalaDinas(): bool
    {
        return auth()->user()->roles->pluck('name')[0] === UserRoleEnum::KEPALA_DINAS->value;
    }
}
