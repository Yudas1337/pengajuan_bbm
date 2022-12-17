<div class="col-12 col-sm-6 col-xxl-3 d-flex">
    <div class="card flex-fill">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $data['totalQuotaByDistrict']  }}</h3>
                    <p class="mb-2">Total Pengajuan Kuota BBM</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">Dari kecamatan</span>
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
                    <h3 class="mb-2">{{ $data['totalUnverifiedSubmissionByDistrict'] }}</h3>
                    <p class="mb-2">Total Pengajuan BBM Belum Terverifikasi</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">dari kecamatan</span>
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
                    <h3 class="mb-2">{{ $data['totalReceiverPerYearByDistrict'] }}</h3>
                    <p class="mb-2">Total Nelayan</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">Tahun ini dari kecamatan</span>
                    </div>
                </div>
                <div class="d-inline-block ms-3">
                    <div class="stat">
                        <i class="align-middle" data-feather="users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
