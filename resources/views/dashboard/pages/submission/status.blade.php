@if($data->status == 0 && is_null($data->validated_by_penyuluh))
    <span class="badge badge-soft-danger">Menunggu verifikasi penyuluh</span>
@elseif($data->status == 1 && is_null($data->validated_by_petugas))
    <span class="badge badge-soft-success">Terverifikasi penyuluh</span>
    <span class="badge badge-soft-danger">Menunggu verifikasi petugas</span>
@elseif($data->status == 1 && is_null($data->validated_by_kepala_dinas))
    <span class="badge badge-soft-success">Terverifikasi penyuluh</span>
    <span class="badge badge-soft-success">Terverifikasi petugas</span>
    <span class="badge badge-soft-danger">Menunggu verifikasi kepala dinas</span>
@else
    <span class="badge badge-soft-success">Pengajuan Berhasil diverifikasi</span>
@endif
