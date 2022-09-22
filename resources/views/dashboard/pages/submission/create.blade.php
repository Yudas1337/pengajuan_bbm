@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman Pengajuan Rekomendasi Subsidi BBM</h1>
        <div class="row">

            <div id="container-error" class="alert alert-danger" style="display: none">
                <ul id="ul-error"></ul>
            </div>
            <form id="smartwizard-validation" method="POST" action="{{ route('submissions.store') }}">
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
                             style="display: block; min-height: 650px">
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Nama Kelompok <small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('group_name') }}" autofocus autocomplete="off"
                                           name="group_name"
                                           type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="form-label col-sm-3 text-sm-right" for="inputEmail4">Nama Ketua
                                    Kelompok <small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input value="{{ old('group_leader') }}" autocomplete="off" name="group_leader"
                                           type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Nomor Surat Pengajuan <small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('letter_number') }}" autocomplete="off" name="letter_number"
                                           type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Tanggal Surat Pengajuan <small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('date') }}" autocomplete="off"
                                           name="date" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Kecamatan <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <select id="select-districts" name="district_id"
                                            class="form-control select2-ajax">
                                        <option value="">--Pilih--</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Desa/Kelurahan <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <select id="select-villages" name="village_id"
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
                                            <input value="{{ $station->id  }}" name="station_id" type="radio"
                                                   class="form-check-input">
                                            <span class="form-check-label">{{ $station->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Tanggal Mulai<small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('start_time') }}" autocomplete="off" name="start_time"
                                           type="datetime-local" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Tanggal Selesai<small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('end_time') }}" autocomplete="off" name="end_time"
                                           type="datetime-local" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="input-detail-data" class="tab-pane" role="tabpanel" style="display: none;">
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Jenis Alat <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input value="Kapal" name="equipment_type" type="radio"
                                               class="form-check-input">
                                        <span class="form-check-label">Kapal</span>
                                    </label> <label class="form-check">
                                        <input value="Pompa" name="equipment_type" type="radio"
                                               class="form-check-input">
                                        <span class="form-check-label">Pompa</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Jumlah Alat<small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('total_equipment') }}" autofocus autocomplete="off"
                                           name="total_equipment" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Fungsi Alat<small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input value="transportasi_pencari_ikan" name="equipment_function" type="radio"
                                               class="form-check-input">
                                        <span class="form-check-label">Transportasi Pencari ikan</span>
                                    </label>
                                    <label class="form-check">
                                        <input value="pengairan" name="equipment_function" type="radio"
                                               class="form-check-input">
                                        <span class="form-check-label">Pengairan</span>
                                    </label>
                                    <label class="form-check">
                                        <input value="nelayan" name="equipment_function" type="radio"
                                               class="form-check-input">
                                        <span class="form-check-label">Nelayan</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Jenis BBM<small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input name="fuel_type" value="Solar" type="radio" class="form-check-input">
                                        <span class="form-check-label">Solar</span>
                                    </label>
                                    <label class="form-check">
                                        <input name="fuel_type" value="Premium" type="radio" class="form-check-input">
                                        <span class="form-check-label">Premium</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Kebutuhan Setiap Alat<small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('equipment_needed') }}" autocomplete="off"
                                           name="equipment_needed"
                                           type="number" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Waktu Operasional Alat<small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('equipment_uptime') }}" autocomplete="off"
                                           name="equipment_uptime" type="datetime-local" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Satuan Waktu<small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input value="hour" name="time_unit" type="radio" class="form-check-input">
                                        <span class="form-check-label">Jam</span>
                                    </label>
                                    <label class="form-check">
                                        <input value="day" name="time_unit" type="radio" class="form-check-input">
                                        <span class="form-check-label">Hari</span>
                                    </label>
                                    <label class="form-check">
                                        <input value="week" name="time_unit" type="radio" class="form-check-input">
                                        <span class="form-check-label">Minggu</span>
                                    </label>
                                    <label class="form-check">
                                        <input value="month" name="time_unit" type="radio" class="form-check-input">
                                        <span class="form-check-label">Bulan</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Formula<small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <input value="{{ old('formula') }}" autocomplete="off" name="formula"
                                           type="number" placeholder="64" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <div class="col-sm-3">
                                    <label class="col-form-label col-sm-12 text-sm-right">Upload Bukti Surat
                                        <small class="text-danger">(Format Pdf & JPEG) *</small></label>
                                </div>


                                <div class="col-sm-6">
                                    <input autocomplete="off" name="letter_file" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
            </form>
            <div id="upload-fisherman-file" class="tab-pane" role="tabpanel"
                 style="display: none; min-height: 350px">
                <form id="excelUploadForm" method="POST" action="{{ route('submission.excelUpload') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-lg-10 alert alert-warning" role="alert">
                            <div class="alert-message">
                                <strong>Note:</strong>
                                <ul>
                                    <li>File harus di upload terlebih dahulu untuk dilakukan validasi
                                        oleh sistem.
                                    </li>
                                    <li>Ekstensi file yang diperbolehkan yaitu excel / csv.</li>
                                    <li>Pastikan file yang dipilih telah benar dan sesuai.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row" hidden>
                        <label class="col-form-label col-sm-3 text-sm-right">Upload Lampiran Data
                            Nelayan<small class="text-danger">*</small> </label>
                        <div class="col-sm-6">
                            <input value="{{ $id }}" id="submission_id" autocomplete="off"
                                   name="submission_id" readonly type="text" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-3 text-sm-right">Upload Lampiran Data
                            Nelayan<small class="text-danger">*</small> </label>
                        <div class="col-sm-6">
                            <input id="excel_file" autocomplete="off" name="excel_file" type="file"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-3 text-sm-right"><small
                                class="text-danger"></small></label>
                        <div class="col-sm-6">
                            <div class="progress">
                                <div id="upload-progress-bar"
                                     class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0"></div>
                            </div>
                            <h5 id="upload-msg" style="display: none" class="mt-3 text-success">File
                                Berhasil
                                di
                                upload</h5>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-3 text-sm-right"><small
                                class="text-danger"></small></label>
                        <div class="col-sm-6">
                            <button id="btn_excel_file" type="submit" name="submit_excel"
                                    class="btn btn-success">Upload
                                File
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <form method="POST" id="receivers-form">
                @csrf
                <div id="data-verification" class="tab-pane" role="tabpanel"
                     style="display: none; min-height: 900px">
                    <div class="mb-3 row">
                        <div class="col-lg-10 alert alert-warning" role="alert">
                            <div class="alert-message">
                                <strong>Note:</strong>
                                <ul>
                                    <li>Data Nelayan yang ditampilkan hanya data yang berstatus: 'Draft', 'Perubahan',
                                        dan 'Tidak Valid'
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <button class="btn btn-danger" type="button" id="load-receivers">Load data</button>
                            <button class="btn btn-success" type="submit">Simpan
                                Perubahan
                            </button>
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
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-3 text-sm-right">Terms and conditions <small
                                class="text-danger">*</small> </label>
                        <div class="col-12">
                            <textarea readonly class="form-control" name="terms" rows="3">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="form-check m-0">
                            <input id="confirmation_checkbox" type="checkbox" name="data_confirmation"
                                   class="form-check-input">
                            <span class="form-check-label">Saya menyetujui syarat dan ketentuan
                                        <small class="text-danger">*</small></span>
                        </label>
                    </div>
                    <div class="mb-3 row">
                        <label class="form-check m-0">
                            <button id="submit-form-button" type="button" class="btn btn-primary" disabled>Submit Data
                            </button>
                        </label>
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
        document.addEventListener("DOMContentLoaded", function () {

            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let upload_msg = $('#upload-msg')
            let submission_id = $('#submission_id').val()

            const HandleError = (errors) => {
                let err = [];
                Object.keys(errors).forEach((k, i) => {
                    errors[k].map((e) => {
                        err = [...err, e]
                    })
                })
                return err
            }

            // form detail
            $('#submit-form-button').click(() => {
                const form = new FormData(document.getElementById('smartwizard-validation'))
                form.append('submission_id', submission_id)

                $.ajax({
                    url: `{{ route('submissions.store') }}`,
                    method: 'post',
                    headers: {
                        _token: CSRF_TOKEN
                    },
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    data: form,
                    success: (data) => {
                        window.location = `{{ route('submissions.index')  }}`
                    },
                    error: (err) => {
                        let errors = HandleError(err.responseJSON.errors)
                        $('#container-error').css('display', 'block')

                        let tags = ``
                        errors.map((data) => {
                            tags += `<li class="mt-1">${data}</li>`
                        })

                        $('#ul-error').html(tags)
                    }
                })
            })

            $('#excel_file').change(() => {
                upload_msg.css('display', 'none')
                $('.progress .progress-bar').css("width", 0 + '%', function () {
                    return $(this).attr("aria-valuenow", 0) + "%";
                })

                $('#upload-progress-bar').attr('class',
                    'progress-bar progress-bar-striped progress-bar-animated bg-success')
                upload_msg.attr('class', 'mt-3 text-success')
                upload_msg.text("Berhasil Upload File")
            })

            $('#excelUploadForm').ajaxForm({
                uploadProgress: function (event, position, total, percentComplete) {
                    $('#upload-msg').css('display', 'block')
                    upload_msg.attr('class', 'mt-3 text-danger')
                    upload_msg.text("upload dan insert data sedang diproses...")
                    let percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage + '%', function () {
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                success: function () {
                    upload_msg.attr('class', 'mt-3 text-success')
                    upload_msg.text("Berhasil Upload File")
                    $('#excel_file').attr('disabled', true)
                    $('#btn_excel_file').attr('disabled', true)
                },
                error: function (err) {
                    let error_msg = err.responseJSON.errors.excel_file[0]
                    $('#upload-progress-bar').attr('class',
                        'progress-bar progress-bar-striped progress-bar-animated bg-danger')
                    upload_msg.attr('class', 'mt-3 text-danger')
                    upload_msg.text(error_msg)
                }
            })

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

            $('#select-districts').change(() => {
                fetchVillages()
            });

            $('#confirmation_checkbox').change((e) => {

                if ($('#confirmation_checkbox').is(':checked')) {
                    $('#submit-form-button').attr('disabled', false)
                } else {
                    $('#submit-form-button').attr('disabled', true)
                }
            })

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
                                array[tr[i].getAttribute('id')][td[j].childNodes[0].name] = td[j].childNodes[0].value
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
