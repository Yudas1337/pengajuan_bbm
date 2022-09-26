@if($data->status == 1 && $now >= $data->start_time && $now <= $data->end_time)
    <span class="badge badge-soft-success">Aktif</span>
@else
    <span class="badge badge-soft-danger">Tidak Aktif</span>
@endif
