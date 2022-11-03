@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Selamat Datang, {{ auth()->user()->name }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $data['totalSubmissions']  }}</h3>
                                <p class="mb-2">Total Pengajuan</p>
                                <div class="mb-0">
                                    <span class="badge badge-soft-success me-2">Dari keseluruhan</span>
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
                                <h3 class="mb-2">{{ $data['totalReceivers']  }}</h3>
                                <p class="mb-2">Total Nelayan</p>
                                <div class="mb-0">
                                    <span class="badge badge-soft-success me-2">Dari keseluruhan</span>
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
        </div>

    </div>
@endsection
