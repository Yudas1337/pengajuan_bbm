@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman Pengajuan Rekomendasi Subsidi BBM</h1>
        <div class="row">

            <div id="container-error" class="alert alert-danger" style="display: none">
                <ul id="ul-error"></ul>
            </div>
            @if($submission->approval_message)
                <div class="alert alert-warning p-3">
                    <p>{{ $submission->approval_message }}</p>
                </div>
            @endif
            @if($submission->note)
                <div class="alert alert-warning p-3">
                    <p>Catatan dari penyuluh : <br>
                        {{ $submission->note }}</p>
                </div>
            @endif
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
                        <li class="nav-item"><a class="nav-link inactive" href="#data-verification">Page 4<br><small>Tambah data pengajuan</small></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="tab-wizard">
                        <div id="input-submission-data" class="tab-pane" role="tabpanel"
                             style="display: block;">
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Nama Kelompok <small
                                        class="text-danger">*</small> </label>
                                <div class="col-sm-6">
                                    <select id="select-group" name="group_id"
                                            class="form-control select2-ajax" {{ auth()->user()->roles->pluck('name')[0] === "Ketua Kelompok" ? 'readonly' : '' }}>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}"
                                                    data-group="{{ $group }}"
                                                    data-district="{{ $group->user->district }}"
                                                    data-village="{{ $group->user->village }}"
                                                    data-station="{{ $group->user->station }}"
                                                    data-submission-station="{{ $submission->station }}"
                                                    data-user="{{ $group->user }}"
                                                {{ $group->group_leader_id === auth()->id() || $submission->group_id === $group->id ? 'selected' : '' }}>{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="form-label col-sm-3 text-sm-right" for="inputEmail4">Nama Ketua
                                    Kelompok <small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input id="leader-name" readonly="true" value="{{ $submission->group_leader }}"
                                           autocomplete="off" name="group_leader"
                                           type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Kecamatan <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <select id="select-districts" name="district_id"
                                            class="form-control select2-districts select-district">
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
                                    <select id="select-villages" name="village_id"
                                            class="form-control select2-villages select-village">
                                        <option value="">--Pilih--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Pilih SPBU <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6" id="stations-container">
{{--                                    @foreach ($stations as $station)--}}
{{--                                        <label class="form-check">--}}
{{--                                            <input--}}
{{--                                                value="{{ $station->id }}" name="station_id" type="radio"--}}
{{--                                                class="form-check-input" readonly="true">--}}
{{--                                            <span class="form-check-label">{{ $station->name }}</span>--}}
{{--                                        </label>--}}
{{--                                    @endforeach--}}
                                </div>
                            </div>
                        </div>
                        <div id="input-detail-data" class="tab-pane" role="tabpanel" style="display: none;">
                            <div class="mb-3 row error-placeholder">
                                <label class="col-form-label col-sm-3 text-sm-right">Jenis Penerima <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input
                                            value="Nelayan" name="receiver_type" type="radio"
                                            class="form-check-input" readonly="true">
                                        <span class="form-check-label">Nelayan</span>
                                    </label> <label class="form-check">
                                        <input
                                            value="Pembudidaya" name="receiver_type" type="radio"
                                            class="form-check-input" readonly="true">
                                        <span class="form-check-label">Pembudidaya</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 row error-placeholder">
                                <div class="col-sm-3">
                                    <label class="col-form-label col-sm-12 text-sm-right">Upload Bukti Surat
                                        <br>
                                        <small class="text-danger">(Tidak Wajib. Format Pdf & JPEG) *</small></label>
                                </div>

                                <div class="col-sm-6">
                                    <input autocomplete="off" name="letter_file" type="file" class="form-control">
                                </div>
                            </div>
                            @if ($submission->letter_file)
                                <div class="mb-3 row error-placeholder">
                                    <div class="col-sm-3">
                                        <label class="col-form-label col-sm-12 text-sm-right">File Tersimpan di:</label>
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
            <div id="upload-fisherman-file" class="tab-pane" role="tabpanel" style="display: none; min-height: 350px">
                <form id="excelUploadForm" method="POST" action="{{ route('submission.excelUpload') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-lg-10 alert alert-warning" role="alert">
                            <div class="alert-message">
                                <strong>Note:</strong>
                                <ul>
                                    <li>File lama sudah tercatat dan tidak harus diupload ulang.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-3 text-sm-right">Contoh Format Excel<small class="text-danger">*</small> </label>
                        <div class="col-sm-6">
                            <a target="_blank" href="{{ asset("FORMAT-PENGAJUAN.xlsx") }}"
                               class="btn btn-success">Download Format Excel
                            </a>
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
                        <label class="col-form-label col-sm-3 text-sm-right"><small class="text-danger"></small></label>
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
                        <label class="col-form-label col-sm-3 text-sm-right"><small class="text-danger"></small></label>
                        <div class="col-sm-6">
                            <button id="btn_excel_file" type="submit" name="submit_excel"
                                    class="btn btn-success">Upload
                                File
                            </button>
                        </div>
                    </div>
                    @if ($submission->excel_file)
                        <div class="mb-3 row error-placeholder">
                            <div class="col-sm-3">
                                <label class="col-form-label col-sm-12 text-sm-right">File Tersimpan di:</label>
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
                <div id="data-verification" class="tab-pane" role="tabpanel" style="display: none; min-height: 1000px">
                    <div class="mb-3 row">
                        <div class="col-lg-10 alert alert-warning" role="alert">
                            <div class="alert-message">
                                <strong>Note:</strong>
                                <ul>
                                    <li>Sebelum melakukan persetujuan atau simpan perubahan mohon dicermati usulan kuota bbm yang sudah diupload
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <button class="btn btn-danger" type="button" id="load-receivers">Tampilkan data</button>
                            <button class="btn btn-success" type="submit">Simpan
                                Perubahan
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <h4>Usulan Kuota Total BBM yang Diajukan : <span id="totalQuota">0</span></h4>
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
                            <button id="submit-form-button" type="button" class="btn btn-success" disabled>Update Data
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

            if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
                const url = window.location.href.split('/')
                const submissionId = url[5].split('#')
                window.location.href = `{{ config('app.url') }}/dashboard/submissions/${submissionId[0]}/edit#input-submission-data`
            }



            $('.select-group').prop('disabled', true);

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

            // set selected value on load
            setSelectedValue()
            // select group change
            $('#select-group').change(function () {
                setSelectedValue()
            })

            function getStationByDistrict(districtId, station) {
                $.ajax({
                    headers: {
                        _token: CSRF_TOKEN
                    },
                    method: 'POST',
                    url: '{{ route("stations.getStationsByDistrict") }}',
                    data: {districtId: districtId, _token: CSRF_TOKEN},
                    dataType : 'JSON',
                    success: function(e){
                        let html = ""
                        e.map((val) => {
                            html += `<label class="form-check">
                                            <input value="${val.id}" name="station_id" type="radio"
                                                   class="form-check-input" readonly required>
                                            <span class="form-check-label">${val.name}</span>
                                        </label>`
                        })

                        $('#stations-container').html(html)

                        let itemStation = $('input[name="station_id"]')
                        for (let i = 0; i < itemStation.length; i++) {
                            if (itemStation[i].value == station.id) {
                                itemStation.removeAttr('checked')
                                itemStation[i].setAttribute('checked', true)
                            }
                        }
                    }
                })
            }

            function setSelectedValue()  {
                $('#stations-container').children('label').remove()

                var select = document.getElementById("select-group");
                var district = JSON.parse(select.options[select.selectedIndex].getAttribute('data-district'))
                var station = JSON.parse(select.options[select.selectedIndex].getAttribute('data-station'))
                var submission_station = JSON.parse(select.options[select.selectedIndex].getAttribute('data-submission-station'))
                console.log(submission_station)
                getStationByDistrict(district.id, (submission_station != null) ? submission_station : station)

                var group = JSON.parse(select.options[select.selectedIndex].getAttribute('data-group'))
                var user = JSON.parse(select.options[select.selectedIndex].getAttribute('data-user'))
                var village = JSON.parse(select.options[select.selectedIndex].getAttribute('data-village'))

                // page 1
                $('#leader-name').val(user.name)
                let optionDistrict = `<option value="${district.id}">${district.name}</option>`
                $('#select-districts').html(optionDistrict)
                let optionVillage = `<option value="${village.id}">${village.name}</option>`
                $('#select-villages').html(optionVillage)



                // page 2
                let receiverType = $('input[name="receiver_type"]')
                for (let i = 0; i < receiverType.length; i++) {
                    if (receiverType[i].value == group.receiver_type) {
                        receiverType.removeAttr('checked')
                        receiverType[i].setAttribute('checked', true)
                    }
                }
            }

            $('#select-districts').select2();
            $('#select-villages').select2();

            // form detail
            $('#submit-form-button').click(() => {
                const form = new FormData(document.getElementById('smartwizard-validation'))
                form.append('submission_id', submission_id)

                for (var pair of form.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                let url = `{{ route('submission.updateSubmission') }}`;
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        _token: CSRF_TOKEN
                    },
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    data: form,
                    success: (data) => {
                        window.location = `{{ route('submissions.index') }}`
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

                    alert("upload sukses")

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

            // Validation
            var $validationForm = $("#smartwizard-validation");
            $validationForm.validate({
                errorPlacement: function errorPlacement(error, element) {
                    $(element).parents(".error-placeholder").append(
                        error.addClass("invalid-feedback small d-block")
                    )
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },
                rules: {
                    "wizard-confirm": {
                        equalTo: "input[name=\"wizard-password\"]"
                    }
                }
            });
            $validationForm
                .smartWizard({
                    autoAdjustHeight: false,
                    backButtonSupport: false,
                    useURLhash: false,
                    showStepURLhash: false,
                    toolbarSettings: {
                        toolbarExtraButtons: [$("<button class=\"btn btn-submit btn-primary\" type=\"button\">Finish</button>")]
                    }
                })
                .on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                    if (stepDirection === 1) {
                        return $validationForm.valid();
                    }
                    return true;
                });
            $validationForm.find(".btn-submit").on("click", function() {
                if (!$validationForm.valid()) {
                    return;
                }
                alert("Great! The form is valid and ready to submit.");
                return false;
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

                            getTotalQuota()

                            alert(data.message)
                        },
                        error: (err) => {
                            console.log(err)
                        }
                    })


                })

                // get total quota
                function getTotalQuota() {
                    $.ajax({
                        url: `{{ route('submission.getTotalQuota', ':submission') }}`.replace(':submission', submission_id),
                        method: 'get',
                        data: {
                            _token: CSRF_TOKEN,
                        },
                        success: (data) => {
                            $('#totalQuota').html(data.data)
                        },
                        error: (err) => {
                            console.log(err)
                        }
                    })
                }

                getTotalQuota()
            })


        });
    </script>
@endsection
