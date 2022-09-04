<?php

enum UserRoleEnum: string{
    case GROUP_LEADER = 'Ketua Kelompok';
    case EXTENSION_WORKER = 'Penyuluh';
    case SERVICE_OFFICER  = 'Petugas Pelayanan';
    case VILLAGE_HEAD = 'Kepala Desa';
    case HEAD_OF_DEPARTMENT = 'Kepala Dinas';
}
