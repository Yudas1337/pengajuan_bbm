<td>
    @if($data->id !== auth()->id())
        @if(request()->routeIs('users.index'))
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Opsi
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('users.edit', $data->id) }}">Edit</a>
                    <a data-toggle="modal" data-target="#exampleModal" data-id='{{ $data->id }}'
                       class="dropdown-item delete">Nonaktifkan</a>
                </div>
            </div>
        @else
            <a data-toggle="modal" data-target="#exampleModal" data-id='{{ $data->id }}' class="btn btn-success delete"><i
                    class="align-middle me-2 fas fa-fw fa-user-check"></i> Aktifkan Pengguna
            </a>
        @endif

    @endif

</td>
