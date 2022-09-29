<?php

namespace App\Helpers;

use App\Enums\UserRoleEnum;

class UserHelper
{
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
     * check role petugas
     * 
     * @return bool
     */

    public static function checkRolePetugas(): bool
    {
        return auth()->user()->roles->pluck('name')[0] === UserRoleEnum::PETUGAS_PELAYANAN->value;
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
