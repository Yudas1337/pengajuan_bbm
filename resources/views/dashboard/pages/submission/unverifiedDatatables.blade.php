<td>
    @if($data->approval_message)
        <span class="badge badge-soft-warning">{{$data->approval_message}}</span>
        <br><br>
    @endif
    <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Opsi
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('submission.unverified_detail', $data->id) }}">Detail Pengajuan</a>
        </div>
    </div>
</td>
