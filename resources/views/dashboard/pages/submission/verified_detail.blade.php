@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman Pengajuan Rekomendasi Subsidi BBM</h1>
        <div class="row">

            <div id="container-error" class="alert alert-danger" style="display: none">
                <ul id="ul-error"></ul>
            </div>
            <form id="smartwizard-validation" method="POST" action="{{ route('submission.updateSubmission') }}">
                @csrf
                <div id="smartwizard-arrows-primary" class="wizard wizard-primary mb-4 sw sw-theme-arrows sw-justified">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link inactive active" href="#input-submission-data">Page 1
                                <br><small>Data
                                    Pengajuan</small></a></li>
                        <li class="nav-item"><a class="nav-link inactive done" href="#input-detail-data">Page
                                2<br><small>Detail
                                    Alat dan BBM</small></a></li>
                        <li class="nav-item"><a class="nav-link inactive" href="#upload-fisherman-file">Page
                                3<br><small>Upload
                                    File Data
                                    Nelayan</small></a>
                        </li>
                        <li class="nav-item"><a class="nav-link inactive" href="#data-verification">Page 4<br><small>Periksa
                                    Data Nelayan</small></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="tab-wizard">
                        <div id="input-submission-data" class="tab-pane" role="tabpanel"
                            style="display: block;">
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Nama Kelompok <small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input disabled value="{{ $submission->group_name }}" autofocus autocomplete="off"
                                        name="group_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="form-label col-sm-3 text-sm-right" for="inputEmail4">Nama Ketua
                                    Kelompok <small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input disabled value="{{ $submission->group_leader }}" autocomplete="off"
                                        name="group_leader" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Kecamatan <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <select disabled id="select-districts" name="district_id"
                                        class="form-control select2-ajax">
                                        <option value="">--Pilih--</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ $submission->district_id == $district->id ? 'selected' : '' }}>
                                                {{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Desa/Kelurahan <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <select disabled id="select-villages" name="village_id"
                                        class="form-control select2-ajax">
                                        <option value="">--Pilih--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Pilih SPBU <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    @foreach ($stations as $station)
                                        <label class="form-check">
                                            <input disabled {{ $submission->station_id == $station->id ? 'checked' : '' }}
                                                value="{{ $station->id }}" name="station_id" type="radio"
                                                class="form-check-input">
                                            <span class="form-check-label">{{ $station->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="input-detail-data" class="tab-pane" role="tabpanel" style="display: none;">
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Jenis Penerima <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input {{ $submission->receiver_type == 'Nelayan' ? 'checked' : '' }}
                                            value="Nelayan" name="receiver_type" type="radio"
                                            class="form-check-input">
                                        <span class="form-check-label">Nelayan</span>
                                    </label> <label class="form-check">
                                        <input {{ $submission->receiver_type == 'Pembudidaya' ? 'checked' : '' }}
                                            value="Pembudidaya" name="receiver_type" type="radio"
                                            class="form-check-input">
                                        <span class="form-check-label">Pembudidaya</span>
                                    </label>
                                </div>
                            </div>
                            @if ($submission->letter_file)
                                <div class="mb-3 row error-placeholder">
                                    <div class="col-sm-3">
                                        <label class="col-form-label col-sm-12 text-sm-right">Bukti surat:</label>
                                    </div>

                                    <div class="col-sm-6">
                                        <a target="_blank" href="{{ asset('storage/' . $submission->letter_file) }}"
                                            class="btn btn-md btn-danger">
                                            <i class="align-middle me-2 fas fa-fw fa-file-pdf"></i>Lihat File</a>
                                    </div>
                                </div>
                            @endif
                        </div>
            </form>
            <div id="upload-fisherman-file" class="tab-pane" role="tabpanel" style="display: none; min-height: 300px">
                <form id="excelUploadForm" method="POST" action="{{ route('submission.excelUpload') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row" hidden>
                        <label class="col-form-label col-sm-3 text-sm-right">Upload Lampiran Data
                            Nelayan<small class="text-danger">*</small> </label>
                        <div class="col-sm-6">
                            <input disabled value="{{ $id }}" id="submission_id" autocomplete="off"
                                name="submission_id" readonly type="text" class="form-control">
                        </div>
                    </div>
                    @if ($submission->excel_file)
                        <div class="mb-3 row error-placeholder">
                            <div class="col-sm-3">
                                <label class="col-form-label col-sm-12 text-sm-right">File excel:</label>
                            </div>
                            <div class="col-sm-6">
                                <a target="_blank" href="{{ asset('storage/' . $submission->excel_file) }}"
                                    class="btn btn-md btn-danger">
                                    <i class="align-middle me-2 fas fa-fw fa-file-excel"></i>Lihat File</a>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
            <form method="POST" id="receivers-form">
                @csrf
                <div id="data-verification" class="tab-pane" role="tabpanel" style="display: none; min-height: 600px">

                    <div class="mb-3 row">
                        <div class="col-12">
                            <button class="btn btn-danger" type="button" id="load-receivers">Load data</button>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <table id="datatables-responsive" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Nelayan</th>
                                        <th>No KTP</th>
                                        <th>Kuota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
            <button class="btn sw-btn-prev disabled" type="button">Kembali</button>
            <button class="btn sw-btn-next" type="button">Lanjut</button>
        </div>
    </div>

    </div>

    </div>
@endsection
@section('footer')
    <script src="{{ asset('app-assets/js/jquery.form.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let upload_msg = $('#upload-msg')
            let submission_id = $('#submission_id').val()


            $("#smartwizard-arrows-primary").smartWizard({
                theme: "arrows",
                autoAdjustHeight: true
            });

            $('.select2-ajax').select2();

            const fetchVillages = () => {
                const id = $('#select-districts').val()
                const url = `{{ route('districts.villages', ':id') }}`.replace(':id', id);
                const select_village = $("#select-villages");
                $.ajax({
                    url: url,
                    method: 'get',
                    success: (data) => {
                        $('#select-villages option').remove();
                        for (let i = 0; i < data.length; i++) {
                            let option = document.createElement("option");
                            option.value = data[i].id;
                            option.text = data[i].name;
                            select_village.append(option);
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }

            const initVillages = () => {
                const id = $('#select-districts').val()
                const url = `{{ route('districts.villages', ':id') }}`.replace(':id', id);
                const select_village = $("#select-villages");
                const initialize_village = `{{ $submission->village_id }}`
                $.ajax({
                    url: url,
                    method: 'get',
                    success: (data) => {
                        $('#select-villages option').remove();
                        for (let i = 0; i < data.length; i++) {
                            let option = document.createElement("option");
                            option.value = data[i].id;
                            option.text = data[i].name;
                            if (data[i].id === initialize_village) {
                                option.setAttribute('selected', true)
                            }
                            select_village.append(option);
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }

            initVillages()

            $('#select-districts').change(() => {
                fetchVillages()
            });

            // form receivers
            $('#load-receivers').click(() => {
                let url = `{{ route('submission.receiver', ':id') }}`.replace(':id', submission_id);
                let dataTables = $("#datatables-responsive").DataTable({
                    scrollX: true,
                    scrollY: '380px',
                    paging: true,
                    pageLength: 100,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: url,
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'receivers.name'
                        },
                        {
                            data: 'national_identity_number',
                            name: 'receivers.national_identity_number'
                        },
                        {
                            data: 'quota',
                            name: 'quota'
                        },
                    ]
                });
                $('#load-receivers').attr('disabled', true)

                $('#receivers-form').submit((e) => {
                    e.preventDefault()

                    let array = {}

                    let table = document.getElementById('datatables-responsive')
                    let tbody = table.childNodes[3]
                    let tr = tbody.children
                    for (let i = 0; i < tr.length; i++) {
                        array[tr[i].getAttribute('id')] = {}
                        let td = tr[i].getElementsByTagName('td')
                        for (let j = 0; j < td.length; j++) {
                            if (td[j].childNodes[0].name !== undefined) {
                                array[tr[i].getAttribute('id')][td[j].childNodes[0].name] = td[j]
                                    .childNodes[0].value
                            }

                        }
                    }

                    $.ajax({
                        url: `{{ route('submission.receiverUpload') }}`,
                        method: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            receivers: array,
                            id: submission_id
                        },
                        success: (data) => {
                            dataTables.ajax.reload();

                            alert(data.message)
                        },
                        error: (err) => {
                            console.log(err)
                        }
                    })

                })
            })


        });
    </script>
@endsection
