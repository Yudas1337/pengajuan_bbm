<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case PENYULUH = "Penyuluh";
    case PETUGAS_PELAYANAN = "Petugas Pelayanan";
    case KETUA_KELOMPOK = "Ketua Kelompok";
    case KEPALA_DESA = "Kepala Desa";
    case KEPALA_DINAS = "Kepala Dinas";
}
