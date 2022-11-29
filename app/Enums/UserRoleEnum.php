<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case PENYULUH = "Penyuluh";
    case ADMIN_TANGKAP = "Admin Tangkap";
    case ADMIN_PEMBUDIDAYA = 'Admin Pembudidaya';
    case KETUA_KELOMPOK = "Ketua Kelompok";
    case KEPALA_DESA = "Kepala Desa";
    case KEPALA_DINAS = "Kepala Dinas";
}
