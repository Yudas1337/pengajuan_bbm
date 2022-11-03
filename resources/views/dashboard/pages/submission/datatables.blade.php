<td>
    <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Opsi
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" disabled="{{ ($data->validated_by_kepala_dinas) ? true : false }}" href="{{ route('submissions.edit', $data->id) }}">Edit</a>
            <a
                disabled="{{ ($data->validated_by_kepala_dinas) ? true : false }}"
                data-toggle="modal"
                data-target="#exampleModal"
                data-id='{{ $data->id }}'
                class="dropdown-item delete">Hapus</a>
        </div>
    </div>
</td>
