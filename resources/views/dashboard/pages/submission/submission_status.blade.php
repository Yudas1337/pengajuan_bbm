@if($data->approval_message)
    <span class="badge badge-soft-danger">Ditolak</span>
@elseif($data->start_time && $data->end_time)
    <span class="badge badge-soft-success">Disetujui</span>
@else
    <span class="badge badge-soft-warning">Diproses</span>
@endif

@if($data->status == 1 && $now >= $data->start_time && $now <= $data->end_time)
    <span class="badge badge-soft-success">Aktif</span>
@else
    <span class="badge badge-soft-danger">Tidak Aktif</span>
@endif
