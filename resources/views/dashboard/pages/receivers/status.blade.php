@if ($data->status == 'Valid')
    <span class="badge badge-soft-success">{{ $data->status }}</span>
@elseif($data->status == 'Tidak Valid')
    <span class="badge badge-soft-danger">{{ $data->status }}</span>
@elseif($data->status == 'Draft')
    <span class="badge badge-soft-secondary">{{ $data->status }}</span>
@else
    <span class="badge badge-soft-warning">{{ $data->status }}</span>
@endif
