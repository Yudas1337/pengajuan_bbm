<td>
    <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Opsi
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('submission.verified_detail', $data->id) }}">Detail Pengajuan</a>
            @if(\App\Helpers\UserHelper::checkRoleTangkap() || \App\Helpers\UserHelper::checkRolePembudidaya() && $data->validated_by_penyuluh != null)
                <a class="dropdown-item" href="{{ route('submission.downloadLetter', $data->id) }}" target="_blank">Download Surat</a>
            @endif
        </div>
    </div>
</td>
