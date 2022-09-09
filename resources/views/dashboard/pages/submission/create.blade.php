@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman Pengajuan Rekomendasi Subsidi BBM</h1>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="mt-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-12 col-xxl-12">
                <form id="smartwizard-validation" method="POST" action="{{ route('submissions.store') }}">
                    @csrf
                    <div id="smartwizard-arrows-primary"
                         class="wizard wizard-primary mb-4 sw sw-theme-arrows sw-justified">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link inactive active"
                                                    href="#input-ships-data">Page 1 <br><small>Data
                                        Kapal</small></a></li>
                            <li class="nav-item"><a class="nav-link inactive done"
                                                    href="#input-detail-data">Page 2<br><small>Detail
                                        Tujuan</small></a></li>
                            <li class="nav-item" id="manifest"><a class="nav-link inactive"
                                                                  href="#input-manifest">Pag
                                    e3<br><small>Manifest</small></a>
                            </li>
                            <li class="nav-item" id="extra-manifest"><a class="nav-link inactive"
                                                                        href="#input-extra-manifest">Page 4<br><small>Manifest
                                        Tambahan</small></a></li>
                        </ul>

                        <div class="tab-content" id="tab-wizard">
                            <div id="input-ships-data" class="tab-pane" role="tabpanel" style="display: block;">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Nama Kelompok<small
                                            class="text-danger">*</small> </label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('shipping_license') }}" autofocus autocomplete="off"
                                               name="shipping_license" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row error-placeholder">
                                    <label class="form-label col-sm-3 text-sm-right" for="inputEmail4">Nama Ketua
                                        Kelompok <small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('shipping_license') }}" autofocus autocomplete="off"
                                               name="shipping_license" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Nomor Surat Pengajuan<small
                                            class="text-danger">*</small> </label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('shipping_license') }}" autofocus autocomplete="off"
                                               name="shipping_license" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Tanggal Surat Pengajuan<small
                                            class="text-danger">*</small> </label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('shipping_license') }}" autofocus autocomplete="off"
                                               name="shipping_license" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Tanggal Surat<small
                                            class="text-danger">*</small> </label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('shipping_license') }}" autofocus autocomplete="off"
                                               name="shipping_license" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Desa/Kelurahan <small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-6">
                                        <select name="nationality_flag" class="form-control">
                                            <option value="">--Pilih--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Kecamatan <small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-6">
                                        <select name="nationality_flag" class="form-control">
                                            <option value="">--Pilih--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Pilih SPBU <small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-6">
                                        <label class="form-check">
                                            <input name="validation-radios" type="radio" class="form-check-input">
                                            <span class="form-check-label">Option one is this and that—be sure to include why it's great</span>
                                        </label>
                                        <label class="form-check">
                                            <input name="validation-radios" type="radio" class="form-check-input">
                                            <span class="form-check-label">Option two can be something else and selecting it will deselect option one</span>
                                        </label>
                                        <label class="form-check">
                                            <input name="validation-radios" type="radio" class="form-check-input">
                                            <span class="form-check-label">Option three is disabled</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div id="input-detail-data" class="tab-pane" role="tabpanel" style="display: none;">
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Tanggal<small
                                            class="text-danger">*</small> </label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('date') }}" autocomplete="off" name="date"
                                               type="datetime-local" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Waktu Keberangkatan<small
                                            class="text-danger">*</small> </label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('depart_time') }}" autocomplete="off" name="depart_time"
                                               type="datetime-local" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Bertolak dari <small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-6">
                                        <select name="departure_from" class="form-control">
                                            <option value="">--Pilih--</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Tujuan <small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-6">
                                        <select name="port_destination" class="form-control">
                                            <option value="">--Pilih--</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Waktu Tiba<small
                                            class="text-danger">*</small> </label>
                                    <div class="col-sm-6">
                                        <input value="{{ old('arrived_time') }}" autocomplete="off" name="arrived_time"
                                               type="datetime-local" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div id="input-manifest" class="tab-pane" role="tabpanel" style="display: none;">
                                <div id="note-manifest"></div>
                                <div class="content-manifest">
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-right">Penumpang Dewasa </label>
                                        <div class="col-sm-6">
                                            <input value="{{ old('total_adult_passenger') }}"
                                                   oninput="this.value = Math.abs(this.value)" min="0"
                                                   autocomplete="off" name="total_adult_passenger" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-right">Penumpang Balita </label>
                                        <div class="col-sm-6">
                                            <input value="{{ old('total_child_passenger') }}"
                                                   oninput="this.value = Math.abs(this.value)" min="0"
                                                   autocomplete="off" name="total_child_passenger" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-right">Penumpang Anggota </label>
                                        <div class="col-sm-6">
                                            <input value="{{ old('total_military_passenger') }}"
                                                   oninput="this.value = Math.abs(this.value)" min="0"
                                                   autocomplete="off" name="total_military_passenger" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="input-extra-manifest" class="tab-pane" role="tabpanel" style="display: none;">
                                <div id="note-extra-manifest"></div>
                                <div class="content-extra-manifest">
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-right">Jumlah Motor </label>
                                        <div class="col-sm-6">
                                            <input value="{{ old('total_motorcycle') }}"
                                                   oninput="this.value = Math.abs(this.value)" min="0"
                                                   autocomplete="off" name="total_motorcycle" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-right">Jumlah Mobil </label>
                                        <div class="col-sm-6">
                                            <input value="{{ old('total_car') }}"
                                                   oninput="this.value = Math.abs(this.value)" min="0"
                                                   autocomplete="off" name="total_car" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-right">Jumlah General Cargo
                                        </label>
                                        <div class="col-sm-6">
                                            <input value="{{ old('general_cargo') }}"
                                                   oninput="this.value = Math.abs(this.value)" min="0"
                                                   autocomplete="off" name="general_cargo" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                            <button class="btn sw-btn-prev disabled" type="button">Kembali</button>
                            <button class="btn sw-btn-next" type="button">Lanjut</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>

    </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
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
            highlight: function (element) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element) {
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
                    toolbarExtraButtons: [$(
                        "<button class=\"btn btn-submit btn-primary\" type=\"button\">Finish</button>"
                    )]
                }
            })
            .on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
                if (stepDirection === 1) {
                    return $validationForm.valid();
                }
                return true;
            });
        $validationForm.find(".btn-submit").on("click", function () {
            if (!$validationForm.valid()) {
                return;
            }
            alert("Great! The form is valid and ready to submit.");
            return false;
        });
        const fetchShipDetails = () => {
            const id = $('#select-ships').val()
            {{--let url = `{{ route('ships.show', ':id') }}`.replace(':id', id);--}}
            $.ajax({
                url: url,
                method: 'get',
                success: (data) => {
                    $('#imo_number').val(data.data.imo_id)
                    $('#ship_type').val(data.data.ship_type.id)
                    if (data.data.ship_types_id === 1) {
                        $('#note-extra-manifest').html(
                            'Kapal cepat hanya memiliki manifest utama')
                        $('#note-manifest').html('')
                        $('.content-manifest').css('display', 'block')
                        $('.content-extra-manifest').css('display', 'none')
                    } else {
                        $('#note-manifest').html('')
                        $('#note-extra-manifest').html('')
                        $('.content-manifest').css('display', 'block')
                        $('.content-extra-manifest').css('display', 'block')
                    }
                },
                error: (err) => {
                    console.log(err)
                }
            })
        }
        if ($('#imo_number').val()) {
            fetchShipDetails()
        }
        $('#select-ships').change(() => {
            fetchShipDetails()
        });
    });
</script>
