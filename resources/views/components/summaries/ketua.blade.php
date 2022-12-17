<div class="col-12 col-sm-6 col-xxl-3 d-flex">
    <div class="card flex-fill">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $data['totalSubmissionThisYear']  }}</h3>
                    <p class="mb-2">Total Pengajuan</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">Keseluruhan tahun ini</span>
                    </div>
                </div>
                <div class="d-inline-block ms-3">
                    <div class="stat">
                        <i class="align-middle" data-feather="check-square"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-xxl-3 d-flex">
    <div class="card flex-fill">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $data['totalAcceptedSubmissionQuotaThisYear']  }}</h3>
                    <p class="mb-2">Total Kuota yang disetujui</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">Keseluruhan Tahun ini</span>
                    </div>
                </div>
                <div class="d-inline-block ms-3">
                    <div class="stat">
                        <i class="align-middle me-2" data-feather="database"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-xxl-3 d-flex">
    <div class="card flex-fill">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $data['totalProgressSubmission']  }}</h3>
                    <p class="mb-2">Total Pengajuan Diproses</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">dari keseluruhan</span>
                    </div>
                </div>
                <div class="d-inline-block ms-3">
                    <div class="stat">
                        <i class="align-middle" data-feather="check-square"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-xxl-3 d-flex">
    <div class="card flex-fill">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $data['totalDeclinedSubmission']  }}</h3>
                    <p class="mb-2">Total Pengajuan Ditolak</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">dari keseluruhan</span>
                    </div>
                </div>
                <div class="d-inline-block ms-3">
                    <div class="stat">
                        <i class="align-middle" data-feather="check-square"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
