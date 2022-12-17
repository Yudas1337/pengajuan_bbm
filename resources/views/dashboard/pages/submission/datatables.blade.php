<td>
    @if($data->approval_message)
        <span class="badge badge-soft-warning">{{$data->approval_message}}</span>
        <br><br>
    @endif
    <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Opsi
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('submissions.edit', $data->id) }}">Edit</a>
            <a
                data-toggle="modal"
                data-target="#exampleModal"
                data-id='{{ $data->id }}'
                class="dropdown-item delete">Hapus</a>
        </div>
    </div>
</td>
